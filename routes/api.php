<?php

use App\Http\Controllers\Api\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;



Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/login', [Usercontroller::class, 'login']);

// lien qui permettra aux Clients
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/create', [PostController::class, 'store']);
Route::put('/posts/update/{post}', [PostController::class, 'update']);
Route::delete('/posts/delete/{post}', [PostController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
