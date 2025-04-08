<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ChangeLanguage;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', ChangeLanguage::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/explore', [PostController::class, 'explore'])
    ->name('explore')
    ->middleware(ChangeLanguage::class);
Route::get('/u/{user:username}', [UserController::class, 'index'])
    ->name('user_profile')
    ->middleware(ChangeLanguage::class);
Route::get('/u/{user:username}/edit', [UserController::class, 'edit'])
    ->middleware(['auth', ChangeLanguage::class])
    ->name('edit_profile');

Route::controller(PostController::class)
    ->middleware(['auth', ChangeLanguage::class])
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::post('/p/create', 'store')->name('store-post');
        Route::get('p/{post:slug}', 'show')->name('show_post');
        Route::delete('/p/{post:slug}/delete', 'destroy')->name('delete_post');
    });

Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])
    ->name('store_post')
    ->middleware(['auth', ChangeLanguage::class]);
Route::patch('/u/{user:username}/update', [UserController::class, 'update'])
    ->middleware(['auth', ChangeLanguage::class])
    ->name('update_profile');

Route::get('/u/{user:username}/follow', [UserController::class, 'follow'])
    ->middleware(['auth', ChangeLanguage::class])
    ->name('follow_user');
Route::get('/u/{user:username}/unfollow', [UserController::class, 'unfollow'])
    ->middleware(['auth', ChangeLanguage::class])
    ->name('unfollow_user');

Route::get('/lang-ar', function () {
    session()->put('lang', 'ar');
    return back();
});

Route::get('/lang-en', function () {
    session()->put('lang', 'en');
    return back();
});

Route::middleware(ChangeLanguage::class)->group(function () {
    require __DIR__ . '/auth.php';
});
