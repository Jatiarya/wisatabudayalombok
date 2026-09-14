<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\TripController as AdminTripController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinasi.show');

Route::get('/paket-trip', [TripController::class, 'index'])->name('trip.index');
Route::get('/paket-trip/{slug}', [TripController::class, 'show'])->name('trip.show');

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('produk.show');

Route::post('/ulasan', [ReviewController::class, 'store'])->name('review.store');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

// Webhook Midtrans - diakses server Midtrans, bukan browser (tanpa auth/CSRF)
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle'])->name('midtrans.callback');

// Public user authentication (pengunjung biasa, bukan admin)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Profil user (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profileedit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    Route::get('/paket-trip/{slug}/pesan', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/paket-trip/{slug}/pesan', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/pesanan', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/pesanan/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/pesanan/{booking}/batalkan', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/bookings/{booking}/pdf', [BookingController::class, 'downloadPdf'])->name('booking.pdf');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store'])->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', AdminCategoryController::class)->except('show');

        Route::resource('destinations', AdminDestinationController::class)->except('show');
        Route::delete('destinations/{destination}/images/{image}', [AdminDestinationController::class, 'destroyImage'])->name('destinations.images.destroy');

        Route::resource('trips', AdminTripController::class)->except('show');
        Route::resource('productcategories', AdminProductCategoryController::class)->except('show');
        Route::resource('products', AdminProductController::class)->except('show');

        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::patch('bookings/{booking}/confirm-payment', [AdminBookingController::class, 'confirmPayment'])->name('bookings.confirmPayment');
        Route::patch('bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
        Route::patch('bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::patch('bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
        Route::delete('bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        Route::get('laporan', [AdminBookingController::class, 'report'])->name('bookings.report');
        Route::get('laporan/export', [AdminBookingController::class, 'exportReport'])->name('bookings.report.export');
        Route::patch('laporan/{booking}/uncomplete', [AdminBookingController::class, 'uncomplete'])->name('bookings.uncomplete');
        Route::get('laporan/data', [AdminBookingController::class, 'reportData'])->name('bookings.report.data');

        Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::patch('reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
        Route::delete('reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});
