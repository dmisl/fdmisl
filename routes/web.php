<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
Route::get('autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete')->middleware('auth');
Route::post('search', [HomeController::class, 'search'])->name('search');

Route::get('login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');


Route::get('profile', [UserController::class, 'index'])->name('profile.index')->middleware('auth');
Route::get('profile/{user}', [UserController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('profile/{user}/friends', [UserController::class, 'friends'])->name('profile.friends')->middleware('auth');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('avatar', [UserController::class, 'avatar'])->name('avatar');
Route::post('addFriend', [UserController::class, 'addFriend'])->name('addFriend');
Route::post('removeFriend', [UserController::class, 'removeFriend'])->name('removeFriend');
Route::resource('posts', PostController::class)->middleware('auth');
