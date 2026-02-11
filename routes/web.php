<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VoteController as AdminVoteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KetuaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Redirect setelah login
Route::get('/redirect-role', [RedirectController::class, 'index'])->middleware('auth');

// Dashboard Default
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| AREA PEMILIH (Akses Umum User Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/voting', [VoteController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VoteController::class, 'vote'])->name('voting.vote');
    // Hasil Realtime mungkin tetap ingin bisa dilihat publik/pemilih?
    // Jika hanya untuk admin, pindahkan ke grup admin di bawah.
    // Route::get('/hasil-realtime', [VoteController::class, 'realtime'])->name('voting.realtime');
});

/*
|--------------------------------------------------------------------------
| AREA ADMIN (Hanya Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Hasil Voting (Sekarang hanya bisa diakses Admin)
    Route::get('/hasil-voting', [VoteController::class, 'hasil'])->name('voting.hasil');

    // Verifikasi/Approve User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::get('/users-json', [UserController::class, 'getUsersJson'])->name('admin.users.json');

    // CRUD Kandidat
    Route::resource('/candidates', CandidateController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');

    Route::get('/hasil-realtime', [VoteController::class, 'realtime'])->name('voting.realtime');

    //Route Admin Voting
    Route::get('/votes', [AdminVoteController::class, 'index'])->name('admin.votes');
    Route::delete('/votes/{id}', [AdminVoteController::class, 'destroy'])->name('admin.votes.delete');
    Route::post('/votes/reset', [AdminVoteController::class, 'reset'])->name('admin.votes.reset');

    Route::resource('/ketua', KetuaController::class);
});

require __DIR__ . '/auth.php';
