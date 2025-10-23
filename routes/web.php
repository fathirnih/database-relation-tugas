<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;

Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::resource('posts', PostController::class, [
        'as' => 'admin' // supaya nama route jadi admin.posts.index, admin.posts.create, dst
    ]);
});


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::get('/', function () {
    return view('home'); })->name('home');

Route::get('/contact', function () {
    return view('contact');})->name('contact');


Route::prefix('login')->group(function () {
    // Form login admin
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('admin.login');

    // Proses login
    Route::post('/submit', [AdminController::class, 'login'])->name('admin.login.submit');

    // Logout
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});