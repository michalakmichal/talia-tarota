<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionController;
use App\Events\Hello;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/{any}', PageController::class)->where('any','.*'); //->where('catchall', '^(?!api).*$'); //idk

Route::get('/broadcast', function(){
    broadcast(new Hello());
    });
Route::get('api/sessions', [SessionController::class, 'index']);
Route::get('api/sessions/{session}', [SessionController::class, 'show']);
Route::post('api/sessions', [SessionController::class, 'store']);
Route::delete('api/sessions', [SessionController::class, 'destroy']);
Route::put('api/sessions', [SessionController::class, 'update']);

Auth::routes();


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
