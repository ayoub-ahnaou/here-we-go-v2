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
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isTouriste' => \App\Http\Middleware\isTouriste::class,
            'isProprietaire' => \App\Http\Middleware\IsProprietaire::class,
            'isAdminOrProprietaire' => \App\Http\Middleware\isAdminOrProprietaire::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
