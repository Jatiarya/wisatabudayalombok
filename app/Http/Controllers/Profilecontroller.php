<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman utama profil (Menampilkan data & riwayat ulasan).
     * Mengarah ke view: profile.index
     */
    public function index(Request $request)
    {
        $reviews = Review::with('reviewable')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('profile', compact('reviews'));
    }

    /**
     * Menampilkan halaman form edit profil (Nama & Email).
     * Mengarah ke view: profile.edit
     */
    public function edit(Request $request)
    {
        return view('profileedit', ['user' => $request->user()]);
    }

    /**
     * Memproses pembaruan data diri (Nama & Email).
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Memproses pembaruan password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->user()->update([
            'password' => bcrypt($validated['password'])
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui.');
    }
}