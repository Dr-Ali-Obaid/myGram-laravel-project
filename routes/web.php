<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/explore', [PostController::class, "explore"])->name('explore');
Route::controller(PostController::class)->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/p/create', 'create')->name('create_post');
    Route::post('/p/create', 'store')->name('store-post');
    Route::get('p/{post:slug}', 'show')->name('show_post');
    Route::get('/p/{post:slug}/edit', 'edit')->name('edit_post');
    Route::patch('/p/{post:slug}/update', 'update')->name('update_post');
    Route::delete('/p/{post:slug}/delete', 'destroy')->name('delete_post');
});


Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('store_post')->middleware('auth');

require __DIR__.'/auth.php';
