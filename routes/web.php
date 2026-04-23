<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PromoController;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN LANDING (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome'); // Hanya berisi tombol Login/Register
});

/*
|--------------------------------------------------------------------------
| 2. PINTU GERBANG DASHBOARD (MENCEGAH ERROR 403 SALAH KAMAR)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Jika yang login adalah Admin, arahkan ke Dashboard Utama (yang ada grafiknya)
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Pastikan mengarah ke .dashboard
    }

    // Jika User Pelanggan, arahkan ke rute Dashboard User
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. AREA PELANGGAN (USER) - WAJIB LOGIN (ROLE: USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    // Fitur Pemesanan
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // Fitur Lacak & Riwayat
    Route::get('/lacak', [OrderController::class, 'track'])->name('order.track');
    Route::get('/riwayat', [OrderController::class, 'history'])->name('order.history');

    // Fitur Edit & Batalkan
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

    // Dashboard User spesifik
    Route::get('/my-dashboard', [OrderController::class, 'userDashboard'])->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| 4. AREA BERSAMA (ADMIN & USER) - BISA DIAKSES KEDUANYA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/order/{id}/struk', [OrderController::class, 'cetakStruk'])->name('order.struk');
    Route::get('/order/{id}/invoice', [OrderController::class, 'invoice'])->name('order.invoice');
});

/*
|--------------------------------------------------------------------------
| 5. AREA ADMIN - WAJIB LOGIN (ROLE: ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard & Monitoring
    Route::get('/dashboard', [AdminOrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/monitoring', [AdminOrderController::class, 'monitoring'])->name('monitoring');

    // Layanan (CRUD)
    Route::resource('services', ServiceController::class);

    // Update Status, Hapus, & Laporan PDF
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/laporan/cetak', [AdminOrderController::class, 'cetakLaporan'])->name('laporan.cetak');

    // Manajemen Pelanggan (CRM)
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Kasir & Konfirmasi Pembayaran
    Route::get('/orders/{id}/kasir', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/konfirmasi-pembayaran', [AdminOrderController::class, 'konfirmasiPembayaran'])->name('orders.konfirmasiPembayaran');

    // Kelola Buku Kas / Pengeluaran (Duplikat sudah dibersihkan)
    Route::resource('expenses', ExpenseController::class);

    // Kode Promo (Duplikat sudah dibersihkan)
    Route::resource('promos', PromoController::class);
});

/*
|--------------------------------------------------------------------------
| 6. PROFIL & AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
