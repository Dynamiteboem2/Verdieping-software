<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function customers()
    {
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->get();
        return view('instructor.customers', compact('bookings'));
    }

    public function cancelBooking(Request $request, $bookingId)
    {
        $booking = \App\Models\Booking::findOrFail($bookingId);
        $reason = $request->input('reason');
        // Send email to customer
        \Mail::to($booking->user->email)->send(new \App\Mail\LessonCancelled($booking, $reason));
        $booking->delete();
        return back()->with('success', 'Les geannuleerd en e-mail verzonden.');
    }
}