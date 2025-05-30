<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class InvoiceController extends Controller
{
    public function index()
    {
        $bookings = \App\Models\Booking::with(['user', 'lesson'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);

        // Calculate totalPaid using a query, not a closure
        $totalPaid = 0;
        $paidBookings = \App\Models\Booking::where('is_paid', true)->with('lesson')->get();
        foreach ($paidBookings as $b) {
            $totalPaid += $b->lesson ? $b->lesson->price : 0;
        }
        $countPaid = \App\Models\Booking::where('is_paid', true)->count();
        $countUnpaid = \App\Models\Booking::where('is_paid', false)->count();

        return view('admin.payments', compact('bookings', 'totalPaid', 'countPaid', 'countUnpaid'));
    }
}
