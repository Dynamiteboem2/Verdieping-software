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
    
    public function updateUser(Request $request, $userId)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $userId,
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = \App\Models\User::findOrFail($userId);
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];
        $user->save();

        return redirect()->back()->with('success', 'Gebruiker bijgewerkt.');
    }

    public function lessons()
    {
        $lessons = \App\Models\Lesson::with(['instructor', 'user'])->get();
        return view('admin.lessons', compact('lessons'));
    }

    public function bookings()
    {
        $bookings = \App\Models\Booking::with(['user', 'instructor', 'lesson'])->get();
        return view('admin.bookings', compact('bookings'));
    }
}