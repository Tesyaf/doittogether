<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamJoinController extends Controller
{
    public function create()
    {
        return view('teams.join');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $team = Team::where('team_code', $request->code)->first();

        if (! $team) {
            return back()
                ->withErrors(['code' => 'Kode tim tidak ditemukan.'])
                ->withInput();
        }

        $alreadyMember = TeamMember::where('team_id', $team->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyMember) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Kamu sudah tergabung di tim ini.');
        }

        TeamMember::create([
            'id_member' => Str::uuid(),
            'team_id' => $team->id,
            'user_id' => Auth::id(),
            'role' => 'member',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Berhasil bergabung ke tim.');
    }
}
