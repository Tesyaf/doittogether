<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.app', function ($view) {

            $user = Auth::user();

            if (!$user) {
                return;
            }

            $teams = $user->teams()->orderBy('name')->get();

            $currentTeam = null;
            if ($teams->isNotEmpty()) {
                $currentTeam = $teams->firstWhere('id', session('team_id'));
                if (!$currentTeam) {
                    $currentTeam = $teams->first();
                    session(['team_id' => $currentTeam->id]);
                }
            }

            $categories = $currentTeam?->categories()->orderBy('name')->get() ?? collect();

            $view->with([
                'teams'        => $teams,
                'currentTeam'  => $currentTeam,
                'categories'   => $categories,
            ]);
        });
    }
}
