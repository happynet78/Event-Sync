<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
    use App\Livewire\Pages\Home;
    use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('change', [LanguageController::class, 'change'])->name('lang.change');
});

require __DIR__.'/auth.php';
