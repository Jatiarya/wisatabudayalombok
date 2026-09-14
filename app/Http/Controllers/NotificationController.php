<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Menampilkan semua notifikasi (Halaman penuh)
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(15);
        return view('notifications.index', compact('notifications'));
    }

    // Menandai satu notifikasi sudah dibaca
    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // Redirect kembali ke halaman sebelumnya
        return back();
    }

    // Menandai semua notifikasi sudah dibaca
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}