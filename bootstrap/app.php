<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withSchedule(
        function ($schedule) {
            $randomHour = rand(1, 5);
            $randomMinute = rand(0, 59);
            $schedule->command('skills:fetch')
                ->cron("$randomMinute $randomHour */2 * *")
                ->withoutOverlapping();
        }
    )
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
