<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::post('/posts', [PostController::class, 'store']);