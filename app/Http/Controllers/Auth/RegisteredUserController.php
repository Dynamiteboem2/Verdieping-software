<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Mail\ActivationMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('RegisterController@store called');

        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'is_active' => false,
            'activation_token' => Str::random(64),
            'role_id' => 3, // Set customer role
        ]);

        Log::info('User created: ' . $user->email);

        try {
            Log::info('Attempting to send activation email to: ' . $user->email);
            Mail::to($user->email)->send(new ActivationMail($user));
            Log::info('Activation email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send activation email: ' . $e->getMessage());
        }

        return redirect()->route('check-email');
    }
}
