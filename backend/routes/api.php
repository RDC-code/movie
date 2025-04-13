<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



Route::middleware('auth:sanctum','role:0')->group(function(){
    Route::get('/users',[AuthController::class,'index']);
});


Route::middleware('auth:sanctum','role:1')->group(function(){
    Route::get('/manager',[ManagerController::class,'index']);
}); 


Route::middleware('auth:sanctum','role:2')->group(function(){
    Route::get('/userdashboard',[UserController::class,'index']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
