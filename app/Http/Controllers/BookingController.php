<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Location;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create()
    {
        $lessons = Lesson::all(); // Ensure this fetches data from the database
        return view('booking.index', compact('lessons'));
    }

    public function createBooking($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId); // Fetch the lesson details
        $instructors = Instructor::all(); // Fetch all instructors

        return view('booking.create', compact('lesson', 'instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'instructor_id' => 'required|exists:instructors,id',
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        // Convert the date to the correct format for MySQL (YYYY-MM-DD)
        $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

        // Determine the user_id
        $userId = auth()->check() ? auth()->id() : null;

        // Create the booking using Eloquent
        Booking::create([
            'lesson_id' => $validated['lesson_id'],
            'instructor_id' => $validated['instructor_id'],
            'user_id' => $userId, // Assign the user_id
            'date' => $formattedDate,
            'time' => $validated['time'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
        ]);

        return redirect()->route('book.lesson')->with('success', 'Lesson booked successfully!');
    }
}
