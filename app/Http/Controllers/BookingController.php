<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Location;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $lessons = Lesson::all();
        $instructors = Instructor::all();
        $locations = Location::all();


        return view('booking.index', compact('lessons', 'instructors', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'instructor_id' => 'required|exists:instructors,id',
            'location_id' => 'required|exists:locations,id',
        ]);

        // Save the booking (you can create a bookings table if needed)
        return redirect()->route('book.lesson')->with('success', 'Lesson booked successfully!');
    }
}
