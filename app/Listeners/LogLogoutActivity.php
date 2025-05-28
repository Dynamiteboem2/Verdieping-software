<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogLogoutActivity
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
    public function handle(Logout $event): void
    {
        $now = now()->format('d-m-Y H:i:s.u');
        $email = $event->user->email ?? 'unknown';
        $logLine = "{$now} | LOGOUT | {$email}\n";
        file_put_contents(storage_path('logs/auth.log'), $logLine, FILE_APPEND);
    }
}
