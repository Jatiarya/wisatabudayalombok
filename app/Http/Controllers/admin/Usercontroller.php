<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount('bookings')
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akunmu sendiri.');
        }

        $user->update(['role' => $validated['role']]);

        $roleLabel = $validated['role'] === 'admin' ? 'Admin' : 'Pengguna';

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$roleLabel}.");
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
