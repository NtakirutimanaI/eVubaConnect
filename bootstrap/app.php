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
        $middleware->alias([
            'admin'      => \App\Http\Middleware\Admin::class,
            'manager'    => \App\Http\Middleware\Manager::class,
            'agent'      => \App\Http\Middleware\Agent::class,
            'customer'   => \App\Http\Middleware\Customer::class,
            'support'    => \App\Http\Middleware\Support::class,
            'inventory'  => \App\Http\Middleware\Inventory::class,
            'hr'         => \App\Http\Middleware\Hr::class,
            'analyst'    => \App\Http\Middleware\Analyst::class,
            'technician' => \App\Http\Middleware\Technician::class,
            'ai'         => \App\Http\Middleware\Ai::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();