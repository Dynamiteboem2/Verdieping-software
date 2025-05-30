<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function allBookings()
    {
        $user = auth()->user();
        $allBookings = $user->bookings()
            ->with('lesson.location')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);

        return view('klant.all-bookings', compact('allBookings'));
    }
}
