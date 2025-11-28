<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Ambil daftar tim user (via pivot team_members)
        $teams = $user->teams()
            ->with('owner')
            ->orderBy('name')
            ->get();

        // Tentukan tim aktif
        $currentTeam = null;

        if ($teams->isNotEmpty()) {
            $currentTeam = $teams->firstWhere('id', session('team_id'));

            if (! $currentTeam) {
                $currentTeam = $teams->first();
                session(['team_id' => $currentTeam->id]);
            }
        }

        // Load kategori untuk sidebar level 2
        $categories = $currentTeam?->categories()->orderBy('name')->get() ?? collect();

        return view('dashboard.index', [
            'teams'        => $teams,
            'currentTeam'  => $currentTeam,
            'categories'   => $categories,
        ]);
    }
}
