<?php

use App\Http\Controllers\AuthCallbackController;
use App\Http\Controllers\AuthRedirectController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Article;
use App\Livewire\Pages\Category;
use App\Livewire\Pages\Home;
use App\livewire\Pages\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/articles/{article:slug}', Article::class)->name('article.show');
Route::get('/{page:slug}', Page::class)->name('page.show');
Route::get('/categories/{category:slug}', Category::class)->name('category.show');

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

Route::middleware('guest')->group(function() {
    Route::get('/auth/redirect/{service}', AuthRedirectController::class)->name('auth.redirect');
    Route::get('/auth/callback/{service}', AuthCallbackController::class)->name('auth.callback');
});
