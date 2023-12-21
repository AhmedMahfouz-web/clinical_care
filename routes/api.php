<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationApiController;
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

Route::group(['middleware' => 'api'], function () {

    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function ($router) {
        Route::post('login/user', 'login_user');
        Route::post('login/doctor', 'login_doctor');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('register/user', 'register_user');
        Route::post('register/doctor', 'register_doctor');
    });

    Route::group(['prefix' => 'user', 'controller' => UserController::class], function ($router) {
        Route::get('/{id}', 'show_user');
        Route::get('/edit/{id}', 'edit_user');
        Route::put('/update/{id}', 'update_user');
        Route::delete('/destroy/{id}', 'destroy_user');
    });

    Route::get('doctor/search/{name}&{profession}', [DoctorController::class, 'search'])->name('search_doctors');

    Route::get('/email/verify/{id}/{hash}', VerificationApiController::class)->name('verification.verify');

    Route::post('create_meeting', [MeetingController::class, 'create_meeting'])->name('create_meeting');
});

Route::middleware(['auth:doctor'])->group(function () {
    Route::group(['prefix' => 'doctor', 'controller' => DoctorController::class], function ($router) {
        Route::get('/{id}', 'show_doctor');
        Route::get('/edit/{id}', 'edit_doctor');
        Route::put('/update/{id}', 'update_doctor');
        Route::delete('/destroy/{id}', 'destroy_doctor');
    });
});
