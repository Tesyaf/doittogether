<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Build the mail representation of the verification notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email — DoItTogether')
            ->view('emails.verify-email', [
                'user' => $notifiable,
                'url' => $verificationUrl,
            ]);
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable): string
    {
        $appUrl = config('app.url');

        $temporarySignedRoute = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        // Ensure the URL uses APP_URL host if URL::temporarySignedRoute returns absolute URL already
        if ($appUrl) {
            // Replace host with APP_URL host to avoid mismatched domain issues
            $parsedBase = parse_url($appUrl);
            $parsedSigned = parse_url($temporarySignedRoute);
            if ($parsedBase && $parsedSigned) {
                $host = $parsedBase['host'] ?? null;
                $scheme = $parsedBase['scheme'] ?? 'http';
                $port = isset($parsedBase['port']) ? ':' . $parsedBase['port'] : '';
                $path = $parsedSigned['path'] ?? '';
                $query = isset($parsedSigned['query']) ? '?' . $parsedSigned['query'] : '';
                return "{$scheme}://{$host}{$port}{$path}{$query}";
            }
        }

        return $temporarySignedRoute;
    }
}
