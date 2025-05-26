<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Adjust these relationships/fields to match your Lesson model and user relation
        $upcomingLessons = $user->lessons()
            ->where('date', '>=', now())
            ->orderBy('date')
            ->get();

        $firstUpcomingLesson = $upcomingLessons->first();

        $previousLessons = $user->lessons()
            ->where('date', '<', now())
            ->orderBy('date', 'desc')
            ->get();

        return view('dashboard', compact('firstUpcomingLesson', 'upcomingLessons', 'previousLessons'));
    }
}