<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class CalendarIntegrationController extends Controller
{
    public function redirect()
    {
        $redirectUri = config('services.google.calendar_redirect') ?: route('calendar.callback');

        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/calendar.events',
                'openid',
                'https://www.googleapis.com/auth/userinfo.profile',
                'https://www.googleapis.com/auth/userinfo.email',
            ])
            ->with([
                'access_type' => 'offline',
                'prompt' => 'consent',
            ])
            ->redirectUrl($redirectUri)
            ->redirect();
    }

    public function callback()
    {
        if (request()->has('error')) {
            Log::warning('Google Calendar: User rejected authorization', ['error' => request('error')]);
            return redirect()->route('profile.show')->with('error', 'Google menolak akses: ' . request('error'));
        }

        try {
            $redirectUri = config('services.google.calendar_redirect') ?: route('calendar.callback');

            $googleUser = Socialite::driver('google')
                ->redirectUrl($redirectUri)
                ->stateless()
                ->user();
        } catch (Throwable $e) {
            Log::error('Google Calendar: Socialite exception', ['error' => $e->getMessage()]);
            return redirect()->route('profile.show')->with('error', 'Gagal menghubungkan Google: ' . $e->getMessage());
        }

        $authUser = Auth::user();
        if (!$authUser) {
            Log::error('Google Calendar: No authenticated user in callback');
            return redirect()->route('login');
        }

        $refreshToken = $googleUser->refreshToken ?: $authUser->google_calendar_refresh_token;

        if (!$refreshToken) {
            Log::warning('Google Calendar: refresh token kosong', ['user_id' => $authUser->id]);
            return redirect()->route('profile.show')->with('error', 'Google tidak mengirim refresh token. Pastikan Anda memilih akun dan memberi izin baru (prompt consent).');
        }

        // Update tokens
        $authUser->google_calendar_access_token = $googleUser->token ?? $authUser->google_calendar_access_token;
        $authUser->google_calendar_refresh_token = $refreshToken;
        $authUser->google_calendar_token_expires_at = now()->addSeconds($googleUser->expiresIn ?? 3600);

        // Explicitly save
        $saved = $authUser->save();

        Log::info('Google Calendar connected', [
            'user_id' => $authUser->id,
            'saved' => $saved,
            'has_refresh' => (bool) $authUser->google_calendar_refresh_token,
            'has_access' => (bool) $authUser->google_calendar_access_token,
        ]);

        return redirect()->route('profile.show')->with('success', 'Google Calendar berhasil terhubung.');
    }

    public function disconnect()
    {
        $user = Auth::user();
        $user->google_calendar_access_token = null;
        $user->google_calendar_refresh_token = null;
        $user->google_calendar_token_expires_at = null;
        $user->save();

        return back()->with('success', 'Google Calendar diputuskan.');
    }

    public function sync(Request $request)
    {
        $user = $request->user();

        if (!$user->google_calendar_refresh_token) {
            Log::warning('Google Calendar sync: No refresh token', ['user_id' => $user->id]);
            return back()->with('error', 'Hubungkan Google Calendar terlebih dahulu.');
        }

        $client = $this->buildGoogleClient($user);
        if (!$client) {
            Log::error('Google Calendar sync: Failed to build client', ['user_id' => $user->id]);
            return back()->with('error', 'Gagal memperbarui token Google. Coba hubungkan ulang.');
        }

        try {
            $service = new Google_Service_Calendar($client);
        } catch (Throwable $e) {
            Log::error('Google Calendar sync: Failed to create service', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal membuat layanan Google Calendar.');
        }

        // Ambil semua task dengan due_at dari tim yang diikuti user
        $teamIds = $user->teams()->pluck('teams.id');
        $tasks = Task::whereIn('team_id', $teamIds)
            ->whereNotNull('due_at')
            ->with('team')
            ->get();

        if ($tasks->isEmpty()) {
            Log::info('Google Calendar sync: No tasks to sync', ['user_id' => $user->id]);
            return back()->with('info', 'Tidak ada tugas untuk disinkronkan.');
        }

        $synced = 0;
        $errors = 0;

        foreach ($tasks as $task) {
            $eventId = 'task-' . md5($task->id);
            $event = new Google_Service_Calendar_Event([
                'id' => $eventId,
                'summary' => $task->title,
                'description' => ($task->description ?? '') . "\nTeam: " . ($task->team->name ?? '-'),
                'start' => [
                    'dateTime' => $task->due_at->toRfc3339String(),
                    'timeZone' => config('app.timezone', 'UTC'),
                ],
                'end' => [
                    'dateTime' => $task->due_at->copy()->addHour()->toRfc3339String(),
                    'timeZone' => config('app.timezone', 'UTC'),
                ],
            ]);

            try {
                $service->events->insert('primary', $event, ['sendUpdates' => 'none']);
                Log::debug('Google Calendar sync: Event inserted', ['user_id' => $user->id, 'task_id' => $task->id]);
                $synced++;
            } catch (\Google_Service_Exception $e) {
                if ($e->getCode() === 409) {
                    try {
                        $service->events->update('primary', $eventId, $event, ['sendUpdates' => 'none']);
                        Log::debug('Google Calendar sync: Event updated', ['user_id' => $user->id, 'task_id' => $task->id]);
                        $synced++;
                    } catch (Throwable $updateErr) {
                        Log::error('Google Calendar sync: Event update failed', ['user_id' => $user->id, 'task_id' => $task->id, 'event_id' => $eventId, 'error' => $updateErr->getMessage()]);
                        $errors++;
                    }
                } else {
                    Log::error('Google Calendar sync: Service exception', ['user_id' => $user->id, 'task_id' => $task->id, 'event_id' => $eventId, 'code' => $e->getCode(), 'error' => $e->getMessage()]);
                    $errors++;
                }
            } catch (Throwable $e) {
                Log::error('Google Calendar sync: General exception', ['user_id' => $user->id, 'task_id' => $task->id, 'event_id' => $eventId, 'error' => $e->getMessage()]);
                $errors++;
            }
        }

        $msg = "Sinkronisasi selesai. Berhasil: {$synced}, Gagal: {$errors}.";
        Log::info('Google Calendar sync completed', [
            'user_id' => $user->id,
            'synced' => $synced,
            'errors' => $errors,
            'total' => $tasks->count(),
        ]);
        return back()->with($errors ? 'warning' : 'success', $msg);
    }

    private function buildGoogleClient($user): ?Google_Client
    {
        if (!$user->google_calendar_refresh_token) {
            Log::error('Google Calendar: No refresh token available', ['user_id' => $user->id]);
            return null;
        }

        try {
            $client = new Google_Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setRedirectUri(config('services.google.redirect'));
            $client->setAccessType('offline');
            $client->setScopes(['https://www.googleapis.com/auth/calendar.events']);

            // Set access token jika masih berlaku
            if ($user->google_calendar_access_token && $user->google_calendar_token_expires_at && $user->google_calendar_token_expires_at->isFuture()) {
                $client->setAccessToken([
                    'access_token' => $user->google_calendar_access_token,
                    'expires_in' => $user->google_calendar_token_expires_at->diffInSeconds(now()),
                    'created' => now()->timestamp,
                ]);
                Log::debug('Google Calendar: Using existing access token', ['user_id' => $user->id]);
                return $client;
            }

            // Refresh token
            Log::info('Google Calendar: Refreshing access token', ['user_id' => $user->id]);
            $client->refreshToken($user->google_calendar_refresh_token);
            $tokens = $client->getAccessToken();

            $user->google_calendar_access_token = $tokens['access_token'] ?? null;
            $user->google_calendar_token_expires_at = now()->addSeconds($tokens['expires_in'] ?? 3600);
            $user->save();

            Log::info('Google Calendar: Token refreshed successfully', ['user_id' => $user->id]);
        } catch (Throwable $e) {
            Log::error('Google Calendar: Failed to build/refresh client', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }

        return $client;
    }
}
