<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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
Route::group([
    'middleware' => ['auth:sanctum']
], function () {
Route::get('/profile', [UserController::class, 'profile']);
Route::put('/updateprofile/{id}', [UserController::class, 'updateProfile']);
});

// ADMIN
Route::group([
    'middleware' => ['auth:sanctum', 'isAdmin']
], function () {
Route::get('/getallusers', [UserController::class, 'getAllUsers']);
Route::get('/getuserbyid/{id}', [UserController::class, 'getUserById']);
Route::delete('/delete/{id}', [UserController::class, 'deleteProfile']);
});

// MESSAGES
Route::middleware('auth:sanctum', 'IsAdmin')->get('/getallmessages', [MessageController::class, 'getAllMessagesByAdmin']);
// Route::middleware('auth:sanctum')->put('/updatemessage/{id}', [MessageController::class, 'updateMessage']);