<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return \App\Models\User::with('image')->find($request->user()->id); // na szybko, zrobic kontroler , uzup. repo itp.
});
/*
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});*/
//Route::middleware('auth:sanctum')->get('/users/{user}/avtivity/{activity_id}', [UserController::class, 'getUsersByList']);
Route::middleware('auth:sanctum')->group( function () {
Route::get('/users/sessions', [UserController::class, 'getUsersByList']);
Route::get('/users/{user}/sessions', [SessionController::class, 'getUserSessions']);
Route::get('/sessions', [SessionController::class, 'index']);
///Route::middleware('auth:sanctum')->get('/sessions', [SessionController::class, 'index']);
Route::get('/sessions/{session}/messages', [MessageController::class, 'getSessionMessages']);
Route::post('/sessions/{session}/messages', [MessageController::class, 'store']);
Route::put('/sessions/{session}', [SessionController::class, 'update']);
///Route::middleware('auth:sanctum')->put('/sessions/{id}', [SessionController::class, 'update']);
Route::patch('/cards/{id}', [CardController::class, 'patch']);
Route::get('/cards/{id}', [CardController::class, 'show']);
Route::get('/cards', [CardController::class, 'index']);
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{id}', [OfferController::class, 'show']);
Route::patch('/offers/{id}', [OfferController::class, 'patch']);

Route::get('/sessions/{session}', [SessionController::class, 'show']);
Route::post('/sessions', [SessionController::class, 'store']);
Route::delete('/sessions', [SessionController::class, 'destroy']);
Route::put('/sessions', [SessionController::class, 'update']);
});
