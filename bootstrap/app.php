<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register global middleware here if needed

        // Register route middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'instructor' => \App\Http\Middleware\InstructorMiddleware::class, // <-- Add this line
            // Add other middleware aliases here if needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Register exception handling here if needed
    })->create();
