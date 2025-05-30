<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function customers()
    {
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->paginate(10); // Paginate 10 per page
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

    public function editBooking($bookingId)
    {
        $booking = \App\Models\Booking::with('user', 'lesson')->findOrFail($bookingId);
        // Only allow editing if this instructor owns the booking
        if ($booking->instructor_id !== auth()->id()) {
            abort(403);
        }
        return view('instructor.edit-booking', compact('booking'));
    }

    public function updateBooking(Request $request, $bookingId)
    {
        $booking = \App\Models\Booking::with('user')->findOrFail($bookingId);
        if ($booking->instructor_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255',
            'user.address' => 'nullable|string|max:255',
            'user.city' => 'nullable|string|max:255',
            'user.mobile' => 'nullable|string|max:20',
        ]);

        // Update lesson data
        $booking->date = $validated['date'];
        $booking->time = $validated['time'];
        $booking->save();

        // Update user data
        $booking->user->name = $validated['user']['name'];
        $booking->user->email = $validated['user']['email'];
        $booking->user->address = $validated['user']['address'] ?? $booking->user->address;
        $booking->user->city = $validated['user']['city'] ?? $booking->user->city;
        $booking->user->mobile = $validated['user']['mobile'] ?? $booking->user->mobile;
        $booking->user->save();

        return redirect()->route('instructor.customers')->with('success', 'Les en persoonsgegevens bijgewerkt.');
    }

    public function destroyBooking($bookingId)
    {
        $booking = \App\Models\Booking::findOrFail($bookingId);
        if ($booking->instructor_id !== auth()->id()) {
            abort(403);
        }
        $booking->delete();
        return back()->with('success', 'Boeking verwijderd.');
    }
}