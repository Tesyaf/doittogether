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
        ], function ($view) {

            $user = Auth::user();

            if (!$user) {
                // Kalau belum login, jangan kirim apa-apa
                $view->with([
                    'teams'       => collect(),
                    'currentTeam' => null,
                    'categories'  => collect(),
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

            $view->with([
                'teams'       => $teams,
                'currentTeam' => $currentTeam,
                'categories'  => $categories,
            ]);
        });
    }
}
