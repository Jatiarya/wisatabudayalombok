<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Turnstile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (blank($value)) {
            $fail('Verifikasi keamanan wajib diselesaikan.');

            return;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('turnstile.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (! $response->successful() || ! ($response->json('success') ?? false)) {
            $fail('Verifikasi keamanan gagal, silakan coba lagi.');
        }
    }
}
