<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Location;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        // Get all instructors (users with role_id = 2)
        $instructors = User::where('role_id', 2)->get();

        return view('booking.create', compact('lesson', 'instructors'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Je moet eerst inloggen om een reservering te maken.');
        }

        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'instructor_id' => 'required|exists:users,id', // <-- FIXED LINE
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'duo_name' => 'nullable|string|max:255',
            'duo_email' => 'nullable|email|max:255',
            'location_id' => 'required|string',
        ]);

        // Convert the date to the correct format for MySQL (YYYY-MM-DD)
        $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

        // Determine the user_id
        $userId = auth()->check() ? auth()->id() : null;

        // Find the location model by name
        $location = \App\Models\Location::where('name', $validated['location_id'])->firstOrFail();

        // Create the booking using Eloquent
        $booking = Booking::create([
            'lesson_id' => $validated['lesson_id'],
            'instructor_id' => $validated['instructor_id'],
            'user_id' => $userId, // Assign the user_id
            'date' => $formattedDate,
            'time' => $validated['time'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'duo_name' => $validated['duo_name'] ?? null,
            'duo_email' => $validated['duo_email'] ?? null,
            'status' => 'voorlopig',
            'is_paid' => false,
            'location_id' => $location->id,
        ]);

        // Send payment email with link to fake iDEAL using a Blade view
        $paymentUrl = route('booking.ideal', $booking->id);
        Mail::send('emails.booking-confirmation', [
            'booking' => $booking,
            'paymentUrl' => $paymentUrl,
        ], function ($message) use ($booking) {
            $message->to($booking->email)
                ->subject('Bevestiging en betaling kitesurfles');
        });

        // Redirect to the booking details page
        return redirect()->route('booking.show', $booking->id);
    }

    public function show($id)
    {
        $booking = Booking::with(['lesson', 'instructor'])->findOrFail($id);

        return view('booking.show', compact('booking'));
    }

    // Mark as paid (for customer)
    public function markPaid($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);
        $booking->is_paid = true;
        $booking->save();
        // Optionally notify owner
        return back()->with('success', 'Betaling gemarkeerd als voldaan.');
    }

    // Cancel booking (for customer)
    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);
        $request->validate(['cancellation_reason' => 'required|string']);
        $booking->cancellation_reason = $request->cancellation_reason;
        $booking->status = 'geannuleerd';
        $booking->save();
        // Optionally notify owner for approval
        return back()->with('success', 'Annulering aangevraagd.');
    }

    // Owner approves cancellation
    public function approveCancellation($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('approve', $booking); // Only owner
        $booking->cancellation_approved = true;
        $booking->save();
        // Allow customer to pick new date
        return back()->with('success', 'Annulering goedgekeurd.');
    }

    // Owner marks as definitief
    public function makeDefinitief($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('approve', $booking); // Only owner
        $booking->status = 'definitief';
        $booking->save();
        // TODO: Send mail to instructor and customer
        return back()->with('success', 'Reservering definitief gemaakt.');
    }

    // Show fake iDEAL page
    public function ideal($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.ideal', compact('booking'));
    }

    // Handle fake iDEAL payment
    public function idealPay(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->is_paid = true;
        $booking->save();
        return redirect()->route('booking.show', $booking->id)->with('success', 'Betaling ontvangen! Je reservering is nu betaald.');
    }
}
