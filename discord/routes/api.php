<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// USER

Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
Route::middleware('auth:sanctum')->put('/updateprofile/{id}', [UserController::class, 'updateProfile']);

// ADMIN

Route::middleware('auth:sanctum','IsAdmin')->get('/getallusers', [UserController::class, 'getAllUsers']);
Route::middleware('auth:sanctum','IsAdmin')->get('/getuserbyid/{id}', [UserController::class, 'getUserById']);
Route::middleware('auth:sanctum','IsAdmin')->delete('/delete/{id}', [UserController::class, 'deleteProfile']);