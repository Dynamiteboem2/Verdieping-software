<?php
// filepath: app/Http/Controllers/Auth/SetPasswordController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SetPasswordController extends Controller
{
    public function setPassword(Request $request, $token)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/',      // hoofdletter
                'regex:/[0-9]/',      // cijfer
                'regex:/[@#\$%\^&\*\(\)_\+\!\?]/', // leesteken
            ],
        ], [
            'password.regex' => 'Het wachtwoord moet minimaal één hoofdletter, één cijfer en één leesteken bevatten.'
        ]);

        $user = User::where('activation_token', $token)->where('is_active', false)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->is_active = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Registratie voltooid!');
    }
}