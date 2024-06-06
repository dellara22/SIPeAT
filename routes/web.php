<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Models\jurusan;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/calendar', [DashboardController::class, 'index'])->name('home');

    Route::get('/ruangan', [DashboardController::class, 'ruangan'])->name('ruangan');

    Route::get('/dashboard', function () {
        return view('user.index');
    })->name('dashboard');

    Route::get('/peminjaman', [DashboardController::class, 'peminjaman'])->name('peminjaman');
    // Route::get('/peminjaman/keterangan', [DashboardController::class, 'keteranganPeminjaman'])->name('ketpeminjaman');
    Route::get('/edit/peminjaman', [PeminjamanController::class, 'show'])->name('editpeminjaman');
    Route::get('/peminjaman/check', [DashboardController::class, 'checkPeminjaman']);
    Route::put('/peminjaman/keterangan/{peminjaman}', [DashboardController::class, 'updatePeminjaman'])->name('update-peminjaman');

    Route::get('/form-peminjaman', [DashboardController::class, 'createPeminjaman'])->name('form-peminjaman');
    Route::post('/form-peminjaman', [DashboardController::class, 'storePeminjaman'])->name('store-peminjaman');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::patch('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        $ruangan = Ruangan::all()->count();
        $pengguna = User::all()->count();
        $jurusan = jurusan::all()->count();
        $peminjaman = Peminjaman::all()->count();
        return view('admin.dashboard', compact('ruangan', 'pengguna', 'jurusan', 'peminjaman'));
    })->name('admin.dashboard');

    Route::get('/data-jurusan', [JurusanController::class, 'index'])->name('admin.jurusan');
    Route::post('/data-jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::delete('/data-jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    Route::get('/data-jurusan/{jurusan}', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/data-jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');

    Route::get('/data-ruangan', [RuanganController::class, 'index'])->name('admin.ruangan');
    Route::post('/data-ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::put('/data-ruangan/{ruangan}', [RuanganController::class, 'update'])->name('ruangan.update');

    Route::get('/data-pengguna', [PenggunaController::class, 'index'])->name('admin.userManagement');
    Route::post('/data-pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');

    Route::get('/data-peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman');
    Route::post('/data-peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::delete('/data-peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::get('/data-peminjaman/{peminjaman}', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/data-peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
