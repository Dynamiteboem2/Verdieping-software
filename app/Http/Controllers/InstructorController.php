<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorController extends Controller
{
    public function customers()
    {
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->paginate(5); // Paginate 10 per page
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
        $booking = \App\Models\Booking::with('user', 'lesson')->findOrFail($bookingId);
        if ($booking->instructor_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255',
            'user.mobile' => 'nullable|string|max:20',
            'location_id' => 'required|string',
        ]);

        // Update lesson data
        $booking->date = $validated['date'];
        $booking->time = $validated['time'];

        // Update location
        $location = \App\Models\Location::where('name', $validated['location_id'])->first();
        if ($location) {
            $booking->lesson->location_id = $location->id;
            $booking->lesson->save();
        }

        $booking->save();

        // Update user data
        $booking->user->name = $validated['user']['name'];
        $booking->user->email = $validated['user']['email'];
        $booking->user->mobile = $validated['user']['mobile'] ?? $booking->user->mobile;
        $booking->user->save();

        // Send mail to customer about the edit using a Blade view
        Mail::send('emails.booking-edited', [
            'booking' => $booking,
        ], function ($message) use ($booking) {
            $message->to($booking->user->email)
                ->subject('Je boeking is aangepast');
        });

        return redirect()->route('instructor.customers')->with('success', 'Les en persoonsgegevens bijgewerkt.');
    }

    public function destroyBooking($bookingId)
    {
        $booking = \App\Models\Booking::with('user')->findOrFail($bookingId);
        if ($booking->instructor_id !== auth()->id()) {
            abort(403);
        }

        // Send mail to customer about deletion using a Blade view
        Mail::send('emails.booking-deleted', [
            'booking' => $booking,
        ], function ($message) use ($booking) {
            $message->to($booking->user->email)
                ->subject('Je boeking is verwijderd');
        });

        $booking->delete();
        return back()->with('success', 'Boeking verwijderd.');
    }

    public function dayOverview(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->whereDate('date', $date)
            ->orderBy('time')
            ->get();
        return view('instructor.overview', [
            'bookings' => $bookings,
            'overviewType' => 'Dag',
            'overviewDate' => $date,
        ]);
    }

    public function weekOverview(Request $request)
    {
        $start = $request->input('start', now()->startOfWeek()->toDateString());
        $end = $request->input('end', now()->endOfWeek()->toDateString());
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->whereBetween('date', [$start, $end])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
        return view('instructor.overview', [
            'bookings' => $bookings,
            'overviewType' => 'Week',
            'overviewDate' => $start . ' t/m ' . $end,
        ]);
    }

    public function monthOverview(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $start = \Carbon\Carbon::parse($month . '-01')->startOfMonth()->toDateString();
        $end = \Carbon\Carbon::parse($month . '-01')->endOfMonth()->toDateString();
        $bookings = \App\Models\Booking::with('user', 'lesson')
            ->where('instructor_id', auth()->id())
            ->whereBetween('date', [$start, $end])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
        return view('instructor.overview', [
            'bookings' => $bookings,
            'overviewType' => 'Maand',
            'overviewDate' => \Carbon\Carbon::parse($start)->translatedFormat('F Y'),
        ]);
    }
}