<?php

// VERSI TERBARU & LENGKAP bootstrap/app.php — ini menggantikan SEMUA snippet
// bootstrap/app.php yang pernah saya kirim sebelumnya (alias admin middleware,
// redirectGuestsTo, dan sekarang tambahan pengecualian CSRF untuk webhook Midtrans).
//
// Cara pakai: buka bootstrap/app.php di project kamu, dan pastikan isinya
// PERSIS seperti struktur di bawah ini (sesuaikan bagian lain kalau project
// kamu sudah punya konfigurasi tambahan di luar yang disebutkan di sini).

use App\Http\Middleware\EnsureUserIsAdmin;
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
        // Alias middleware 'admin' untuk proteksi route panel admin
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);

        // Redirect tamu (belum login) ke halaman login yang sesuai:
        // /admin/* -> admin.login, selain itu -> login (user biasa)
        $middleware->redirectGuestsTo(function ($request) {
            return $request->is('admin*') ? route('admin.login') : route('login');
        });

        // PENTING (BARU) — webhook Midtrans dikirim server-to-server oleh
        // Midtrans, bukan lewat browser, jadi TIDAK PUNYA CSRF token Laravel.
        // Kalau tidak dikecualikan, notifikasi pembayaran akan selalu ditolak
        // dengan error 419 Page Expired dan status booking tidak akan pernah
        // otomatis ter-update.
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
