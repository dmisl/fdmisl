<?php

use App\Http\Controllers\Profile\PostController;
use Illuminate\Support\Facades\Route;

Route::post('profile', [PostController::class, 'store'])->name('profile.store');
Route::post('comment', [PostController::class, 'comment'])->name('comment');
Route::post('like', [PostController::class, 'like'])->name('like');
Route::post('save', [PostController::class, 'save'])->name('save');