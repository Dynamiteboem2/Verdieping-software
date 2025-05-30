<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Mail\LessonCancelled;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Http\Requests\StoreAdminUserRequest;

class AdminController extends Controller
{
    public function users()
    {
        $users = \App\Models\User::paginate(5); // Use paginate instead of all()
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->back()->with('success', 'Rol bijgewerkt!');
    }
    
    public function updateUser(UpdateAdminUserRequest $request, $userId)
    {
        $validated = $request->validated();

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

    public function createUser(StoreAdminUserRequest $request)
    {
        $validated = $request->validated();

        $user = \App\Models\User::create([
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'is_active' => true,
        ]);

        // Send styled mail to the new user with the password using a Blade view
        \Illuminate\Support\Facades\Mail::send('emails.admin-user-created', [
            'email' => $user->email,
            'password' => $validated['password'],
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Je account is aangemaakt');
        });

        return redirect()->back()->with('success', 'Gebruiker succesvol aangemaakt en e-mail verstuurd.');
    }
}