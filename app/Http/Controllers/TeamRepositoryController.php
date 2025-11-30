<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamRepositoryController extends Controller
{
    public function edit(Team $team)
    {
        $this->ensureOwner($team);

        $repository = $team->repository;
        $webhookUrl = $repository ? route('webhooks.github', $repository) : null;
        $isOwnerOrAppAdmin = $this->isOwnerOrAppAdmin($team);

        return view('repositories.edit', compact('team', 'repository', 'webhookUrl', 'isOwnerOrAppAdmin'));
    }

    public function upsert(Request $request, Team $team)
    {
        $this->ensureOwner($team);

        $data = $request->validate([
            'repo_full_name' => ['required', 'string', 'max:150', 'regex:/^[A-Za-z0-9_.-]+\\/[A-Za-z0-9_.-]+$/'],
            'branch' => ['nullable', 'string', 'max:100'],
        ]);

        $normalizedRepo = strtolower($data['repo_full_name']);

        $conflict = TeamRepository::where('provider', 'github')
            ->where('repo_full_name', $normalizedRepo)
            ->where('team_id', '!=', $team->id)
            ->first();

        if ($conflict) {
            return back()
                ->withErrors(['repo_full_name' => 'Repo ini sudah terhubung ke tim lain. Putuskan dulu di tim tersebut sebelum menyambungkan di sini.'])
                ->withInput();
        }

        $repository = $team->repository()->firstOrNew([]);

        if (!$repository->exists) {
            $repository->id = (string) Str::uuid();
            $repository->provider = 'github';
            $repository->team_id = $team->id;
            $repository->webhook_secret = Str::random(64);
        }

        $repository->repo_full_name = $normalizedRepo;
        $repository->branch = $data['branch'] ?: null;
        $repository->save();

        return redirect()
            ->route('repositories.commits', $team->id)
            ->with('success', 'Repo GitHub berhasil disambungkan.');
    }

    public function disconnect(Team $team)
    {
        $this->ensureOwner($team);

        if ($team->repository) {
            $team->repository->delete();
        }

        return back()->with('success', 'Integrasi repo telah diputus.');
    }

    public function commits(Team $team)
    {
        $this->ensureMember($team);

        $repository = $team->repository;
        $commits = $repository
            ? $repository->commits()->orderByDesc('committed_at')->paginate(20)
            : null;
        $webhookUrl = $repository ? route('webhooks.github', $repository) : null;
        $isTeamOwnerOrAppAdmin = $this->isOwnerOrAppAdmin($team);

        return view('repositories.commits', compact('team', 'repository', 'commits', 'webhookUrl', 'isTeamOwnerOrAppAdmin'));
    }

    private function ensureOwner(Team $team)
    {
        $isOwner = $this->isOwnerOrAppAdmin($team);

        abort_unless($isOwner, 403);
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }

    private function isOwnerOrAppAdmin(Team $team): bool
    {
        $isOwner = $team->members()
            ->where('user_id', Auth::id())
            ->where('role', 'owner')
            ->exists();

        return $isOwner || Auth::user()?->is_admin;
    }
}
