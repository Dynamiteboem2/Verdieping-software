<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Location;
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
        ]);

        // Convert the date to the correct format for MySQL (YYYY-MM-DD)
        $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

        DB::table('bookings')->insert([
            'lesson_id' => $validated['lesson_id'],
            'instructor_id' => $validated['instructor_id'],
            'date' => $formattedDate,
            'time' => $validated['time'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('book.lesson')->with('success', 'Lesson booked successfully!');
    }
}
