<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isInstructor = $user->role_id == 2; // Adjust as needed

        if ($isInstructor) {
            // Bookings where this user is the instructor
            $instructorBookings = $user->instructorBookings()
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('time')
                ->with('lesson.location', 'user')
                ->get();

            return view('dashboard', compact('instructorBookings', 'isInstructor', 'user'));
        } else {
            // Customer logic (bookings)
            $upcomingLessons = $user->bookings()
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('time')
                ->with('lesson.location')
                ->paginate(2); // Paginate 2 per page

            $firstUpcomingLesson = $upcomingLessons->first();

            $previousLessons = $user->bookings()
                ->whereDate('date', '<', now()->toDateString())
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->with('lesson.location')
                ->get();

            return view('dashboard', compact('firstUpcomingLesson', 'upcomingLessons', 'previousLessons', 'isInstructor', 'user'));
        }
    }
}