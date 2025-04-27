<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Movie APIs
Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::post('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

// User Routes with auth:sanctum

    Route::get('/users', [UserController::class, 'users']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);

    Route::get('/user/profile', [UserController::class, 'profile']); // for logged in user info


// Role Middleware
Route::middleware(['auth:sanctum', 'role:0'])->group(function() {
    Route::get('/admin', [AuthController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:1'])->group(function() {
    Route::get('/manager', [ManagerController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:2'])->group(function() {
    Route::get('/userdashboard', [UserController::class, 'index']);
});
