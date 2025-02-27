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

//Auth APIs
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);


//Event APIs
Route::get('/get/verified/events', [\App\Http\Controllers\EventController::class, 'getVerifiedEvents']);


Route::group(['middleware' => ['jwt.middleware']], function () {
    //Event APIs
    Route::post('/create/event', [\App\Http\Controllers\EventController::class, 'createEvent']);
    Route::get('/get/events', [\App\Http\Controllers\EventController::class, 'getEvents'])->middleware('admin');
    Route::put('/verify/event/{id}', [\App\Http\Controllers\EventController::class, 'verifyEvent'])->middleware('admin');
    Route::get('/get/organizer/events', [\App\Http\Controllers\EventController::class, 'getOrganizerEvents'])->middleware('organizer');


    //Statistics
    Route::get('/get/admin/statistics', [\App\Http\Controllers\AdminController::class, 'getAdminDashboardStatistics'])->middleware('admin');
    Route::get('/get/organizer/statistics', [\App\Http\Controllers\OrganizerController::class, 'getOrganizerDashboardStatistics'])->middleware('organizer');
});
