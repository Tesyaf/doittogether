<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $teams = auth()->user()->teams()->orderBy('name')->get();
        return view('dashboard.user', compact('teams'));
    }
}
