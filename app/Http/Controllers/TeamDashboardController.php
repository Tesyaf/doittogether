<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamDashboardController extends Controller
{
    public function index()
    {
        return view('teams.dashboard', [
            'teams' => $teams,
        ]);
    }
}
