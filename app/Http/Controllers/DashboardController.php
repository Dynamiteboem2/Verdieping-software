<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $upcomingLessons = $user->bookings()
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->with('lesson.location')
            ->get();

        $firstUpcomingLesson = $upcomingLessons->first();

        $previousLessons = $user->bookings()
            ->whereDate('date', '<', now()->toDateString())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->with('lesson.location')
            ->get();

        return view('dashboard', compact('firstUpcomingLesson', 'upcomingLessons', 'previousLessons'));
    }
}