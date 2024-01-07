<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TestController;
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
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('login/user', 'login_user');
        Route::post('login/doctor', 'login_doctor');
        Route::post('register/user', 'register_user');
        Route::post('register/doctor', 'register_doctor');
    });

    Route::group(['prefix' => 'user', 'controller' => UserController::class], function ($router) {
        Route::get('/{id}', 'show_user');
        Route::get('/edit/{id}', 'edit_user');
        Route::put('/update/{id}', 'update_user');
        Route::delete('/destroy/{id}', 'destroy_user');
    });


    Route::get('/email/verify/{id}/{hash}', VerificationApiController::class)->name('verification.verify');

    Route::post('create_meeting', [MeetingController::class, 'create_meeting'])->name('create_meeting');

    Route::group(['prefix' => 'report', 'controller' => ReportController::class], function ($router) {
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::get('my_reports/{report}', 'get_report');
        Route::get('my_reports', 'get_all_reports');
    });

    Route::group(['prefix' => 'reservation', 'controller' => ReservationController::class], function ($router) {
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::get('my_reservations/{report}', 'get_reservation');
        Route::get('my_reservations', 'get_all_reservations');
    });
    Route::get('doctor/search/{name}&{profession}', [DoctorController::class, 'search'])->name('search_doctors');

    Route::group(['prefix' => 'doctor', 'controller' => DoctorController::class], function ($router) {
        Route::get('/doctor/profile', 'profile');
        Route::get('/edit', 'edit_doctor');
        Route::post('/update/{doctor}', 'update_doctor');
        Route::delete('/destroy/{doctor}', 'destroy_doctor');
    });
});

Route::get('access_token', [AccessTokenController::class, 'generate_token']);

Route::get('notifications', [NotificationsController::class, 'get_notification']);
Route::get('notifications/{notification}', [NotificationsController::class, 'read_notification']);

Route::group(['prefix' => 'doctor', 'controller' => DoctorController::class], function ($router) {
    Route::get('/{doctor}', 'show_doctor');
    Route::get('/', 'show_all_doctors');
    Route::get('/home', 'show_all_doctors_home');
});

Route::middleware(['auth:doctor'])->group(function () {
    Route::post('/report/{report}/answer', [ReportController::class, 'answer']);
});

Route::get('get_professions', [ProfessionController::class, 'index_api']);
Route::get('get_partners', [PartnerController::class, 'index_api']);

Route::post('/token', [MeetingController::class, 'start_meeting']);


Route::group(['prefix' => 'contact', 'controller' => ContactController::class], function ($router) {
    Route::post('/send_message', 'send_message');
});
