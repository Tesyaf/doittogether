<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->orderBy('name');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function toggleAdmin(User $user)
    {
        // Larang cabut/grant ke diri sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa mengubah status admin diri sendiri.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', "Status admin untuk {$user->name} diperbarui.");
    }
}
