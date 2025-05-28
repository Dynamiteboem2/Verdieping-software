<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogAuthActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $now = now()->format('d-m-Y H:i:s.u');
        $email = $event->user->email;
        $logLine = "{$now} | LOGIN | {$email}\n";
        file_put_contents(storage_path('logs/auth.log'), $logLine, FILE_APPEND);
    }
}
