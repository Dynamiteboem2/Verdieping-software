<?php
namespace App\Helpers;

class AuthLogger
{
    public static function log($event, $email)
    {
        $now = now()->format('Y-m-d H:i:s.u');
        $logLine = "{$now} | {$event} | {$email}\n";
        file_put_contents(storage_path('logs/auth.log'), $logLine, FILE_APPEND);
    }
}