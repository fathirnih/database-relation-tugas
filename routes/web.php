<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::get('/', function () {
    return view('home'); })->name('home');

Route::get('/categories', function () {
    return view('categories'); })->name('categories');

Route::get('/contact', function () {
    return view('contact');})->name('contact');