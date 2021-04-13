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
Route::middleware('auth:sanctum')->get('/users/sessions', [UserController::class, 'getUsersByList']);
Route::middleware('auth:sanctum')->get('/users/{user}/sessions', [SessionController::class, 'getUserSessions']);
Route::middleware('auth:sanctum')->get('/sessions', [SessionController::class, 'index']);
///Route::middleware('auth:sanctum')->get('/sessions', [SessionController::class, 'index']);
Route::middleware('auth:sanctum')->get('/sessions/{session}/messages', [MessageController::class, 'getSessionMessages']);
Route::middleware('auth:sanctum')->post('/sessions/{session}/messages', [MessageController::class, 'store']);
Route::middleware('auth:sanctum')->put('/sessions/{session}', [SessionController::class, 'update']);
///Route::middleware('auth:sanctum')->put('/sessions/{id}', [SessionController::class, 'update']);
Route::middleware('auth:sanctum')->patch('/cards/{id}', [CardController::class, 'patch']);
Route::middleware('auth:sanctum')->get('/cards/{id}', [CardController::class, 'show']);
Route::middleware('auth:sanctum')->get('/cards', [CardController::class, 'index']);
Route::middleware('auth:sanctum')->get('/offers', [OfferController::class, 'index']);
Route::middleware('auth:sanctum')->get('/offers/{id}', [OfferController::class, 'show']);
Route::middleware('auth:sanctum')->patch('/offers/{id}', [OfferController::class, 'patch']);
