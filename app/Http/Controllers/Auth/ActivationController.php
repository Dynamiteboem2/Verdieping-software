<?php
// filepath: app/Http/Controllers/Auth/ActivationController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate($token)
    {
        $user = User::where('activation_token', $token)->where('is_active', false)->firstOrFail();
        return view('auth.set-password', compact('user', 'token'));
    }
}