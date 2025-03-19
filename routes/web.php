<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/explore', [PostController::class, "explore"])->name('explore');
Route::get("/u/{user:username}", [UserController::class, "index"])->name("user_profile");
Route::get("/u/{user:username}/edit", [UserController::class, "edit"])->middleware("auth")->name("edit_profile");

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
Route::patch("/u/{user:username}/update", [UserController::class, "update"])->middleware("auth")->name("update_profile");

Route::get("/u/{user:username}/follow", [UserController::class, "follow"])->middleware("auth")->name("follow_user");
Route::get("/u/{user:username}/unfollow", [UserController::class, "unfollow"])->middleware("auth")->name("unfollow_user");

require __DIR__.'/auth.php';
