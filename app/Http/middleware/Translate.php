<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Translate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah ada session 'locale', jika tidak ada gunakan default 'id' (Indonesia)
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale('id');
        }

        return $next($request);
    }
}