<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
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
    'middleware' => ['auth:sanctum', 'IsAdmin']
], function () {
Route::get('/getallusers', [UserController::class, 'getAllUsers']);
Route::get('/getuserbyid/{id}', [UserController::class, 'getUserById']);
Route::delete('/delete/{id}', [UserController::class, 'deleteProfile']);
});

// MESSAGES
Route::middleware('auth:sanctum')->get('/getallmessages', [MessageController::class, 'getAllMessages']);
Route::middleware('auth:sanctum')->get('/getmessagesbyparty/{id}', [MessageController::class, 'getMessagesByParty']);
Route::middleware('auth:sanctum')->post('/createmessage', [MessageController::class, 'createMessage']);
Route::middleware('auth:sanctum','IsAdmin')->delete('/deletemessage/{id}', [MessageController::class, 'deleteMessage']);
Route::middleware('auth:sanctum','IsAdmin')->put('/updatemessage/{id}', [MessageController::class, 'updateMessage']);


// GAME
Route::middleware('auth:sanctum', 'IsAdmin')->post('/creategame', [GameController::class, 'createGame']);

// PARTY
Route::middleware('auth:sanctum')->post('/createparty', [PartyController::class, 'createParty']);
Route::get('/party/{id}', [PartyController::class, 'getPartyByGame']);
Route::middleware('auth:sanctum')->post('/join/{id}',[PartyController::class, 'joinPartyById']);
