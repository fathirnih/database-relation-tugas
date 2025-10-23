<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::get('/', function () {
    return view('home'); })->name('home');

Route::get('/contact', function () {
    return view('contact');})->name('contact');


    use App\Http\Controllers\AdminController;

// Form login admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// Proses login
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Dashboard admin (hanya bisa diakses setelah login)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin.auth');

// Logout
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
