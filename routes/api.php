<?php

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

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::group(['middleware' => ['jwt.middleware']], function () {
    Route::post('/create/event', [\App\Http\Controllers\EventController::class, 'createEvent']);
    Route::get('/get/events', [\App\Http\Controllers\EventController::class, 'getVerifiedEvents']);
    Route::put('/verify/event/{id}', [\App\Http\Controllers\EventController::class, 'verifyEvent'])->middleware('admin');
});
