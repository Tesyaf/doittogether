<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamDashboardController extends Controller
{
    public function index()
    {
        return view('team.dashboard');
    }
}
