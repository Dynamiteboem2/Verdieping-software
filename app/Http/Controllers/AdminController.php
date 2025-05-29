<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Mail\LessonCancelled;
use Illuminate\Support\Facades\Mail;

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

    public function bookings(Request $request)
    {
        $query = \App\Models\Booking::with(['user', 'instructor', 'lesson']);

        // Filter by instructor
        if ($request->filled('instructor')) {
            $query->where('instructor_id', $request->instructor);
        }

        // Filter by period
        if ($request->period === 'week') {
            $query->whereBetween('date', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString()
            ]);
        } elseif ($request->period === 'month') {
            $query->whereMonth('date', now()->month)
                  ->whereYear('date', now()->year);
        } elseif ($request->period === 'year') {
            $query->whereYear('date', now()->year);
        }

        $bookings = $query->paginate(5); // <-- Pagination here

        return view('admin.bookings', compact('bookings'));
    }

    public function notifyBooking(Request $request, Booking $booking)
    {
        $type = $request->input('type');
        $reason = null;

        if ($type === 'sick_instructor') {
            $reason = 'ziekte';
        } elseif ($type === 'windkracht') {
            $reason = 'wind';
        }

        if ($reason) {
            Mail::to($booking->user->email)->send(new LessonCancelled($booking, $reason));
            $booking->delete(); // Delete the booking after notifying
            return redirect()->back()->with('success', 'Annulering verstuurd en boeking verwijderd.');
        }

        return redirect()->back()->with('success', 'Geen geldige reden opgegeven.');
    }
}