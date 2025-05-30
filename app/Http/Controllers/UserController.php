<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function completeProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'birthdate' => 'required|date_format:d-m-Y',
            'mobile' => 'required|string|max:20',
            'bsn_number' => $user->role_id == 2 ? 'required|string|max:20' : 'nullable|string|max:20',
        ]);

        // Convert birthdate to Y-m-d for database
        $validated['birthdate'] = Carbon::createFromFormat('d-m-Y', $validated['birthdate'])->format('Y-m-d');

        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'Profielgegevens opgeslagen.');
    }
}
