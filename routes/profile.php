<?php

use App\Http\Controllers\Profile\PostController;
use Illuminate\Support\Facades\Route;

Route::post('profile', [PostController::class, 'store'])->name('profile.store');