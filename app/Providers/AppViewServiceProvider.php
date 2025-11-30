<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Semua layout yang butuh data tim pakai logic yang sama
        View::composer([
            'layouts.team-app',
            'layouts.user-app',
            'layouts.sidebar-global',
            'layouts.sidebar-team',
            'repositories.edit',
            'repositories.commits',
        ], function ($view) {

            $user = Auth::user();

            if (!$user) {
                // Kalau belum login, jangan kirim apa-apa
                $view->with([
                    'teams'                  => collect(),
                    'currentTeam'            => null,
                    'categories'             => collect(),
                    'currentMember'          => null,
                    'isTeamOwner'            => false,
                    'isTeamAdmin'            => false,
                    'isTeamOwnerOrAdmin'     => false,
                    'isTeamOwnerOrAppAdmin'  => false,
                    'isAppAdmin'             => false,
                    'teamRepository'         => null,
                ]);
                return;
            }

            // PENTING: pakai relasi user->teams(), bukan Team::where('user_id')
            $teams = $user->teams()->orderBy('name')->get();

            // Tentukan currentTeam berdasar session('team_id')
            $currentTeam = null;
            if ($teams->isNotEmpty()) {
                $currentTeam = $teams->firstWhere('id', session('team_id'));

                if (!$currentTeam) {
                    $currentTeam = $teams->first();
                    session(['team_id' => $currentTeam->id]);
                }
            }

            // Ambil kategori milik current team (kalau ada)
            $categories = $currentTeam?->categories()->orderBy('name')->get() ?? collect();

            $currentMember = $currentTeam?->members()->where('user_id', $user->id)->first();
            $isTeamOwner = $currentMember?->role === 'owner';
            $isTeamAdmin = $currentMember?->role === 'admin';
            $isAppAdmin = (bool) ($user?->is_admin);
            $teamRepository = $currentTeam?->repository;
            $githubInstallUrl = config('services.github_app.install_url');

            $view->with([
                'teams'                 => $teams,
                'currentTeam'           => $currentTeam,
                'categories'            => $categories,
                'currentMember'         => $currentMember,
                'isTeamOwner'           => $isTeamOwner,
                'isTeamAdmin'           => $isTeamAdmin,
                'isTeamOwnerOrAdmin'    => $isTeamOwner || $isTeamAdmin,
                'isTeamOwnerOrAppAdmin' => $isTeamOwner || $isAppAdmin,
                'isAppAdmin'            => $isAppAdmin,
                'teamRepository'        => $teamRepository,
                'githubInstallUrl'      => $githubInstallUrl,
            ]);
        });
    }
}
