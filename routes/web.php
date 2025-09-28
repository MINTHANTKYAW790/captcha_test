<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth',  'verified'])->group(function () {
    Route::get('/store/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/store/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/two-factor-authentication', [ProfileController::class, 'twoFactor'])
         ->name('two-factor-authentication.show');
});

require __DIR__.'/auth.php';
