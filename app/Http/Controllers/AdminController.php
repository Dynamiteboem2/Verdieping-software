<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = \App\Models\User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->back()->with('success', 'Rol bijgewerkt!');
    }
}