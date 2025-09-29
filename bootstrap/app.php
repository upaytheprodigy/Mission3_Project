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
        // --- Inilah bagian yang Anda tambahkan/modifikasi ---

        // Daftarkan alias 'role' Anda di sini
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Anda juga bisa menambahkan middleware lain di sini jika perlu
        // Contoh:
        // $middleware->append(AnotherMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Konfigurasi exception handling (biasanya dibiarkan default)
    })->create();