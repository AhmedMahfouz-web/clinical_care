<?php

use App\Events\MeetingScheduled;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['prefix' => 'dashboard'], function ($router) {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'adminauth:admin'], function () {
        Route::get('/', [Controller::class, 'index'])->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

        Route::group(['prefix' => 'admin'], function ($router) {
            Route::group(['controller' => AdminController::class], function () {
                Route::get('/', 'index')->name('show admins');
                Route::get('/create_admin', 'create')->name('create admin');
                Route::post('/store_admin', 'store')->name('store admin');
                Route::get('/edit_admin/{admin}', 'edit')->name('edit admin');
                Route::post('/update_admin/{admin}', 'update')->name('update admin');
                Route::post('/delete_admin/{admin}', 'destroy')->name('delete admin');
            });
        });

        Route::group(['prefix' => 'profession'], function ($router) {
            Route::group(['controller' => ProfessionController::class], function () {
                Route::get('/', 'index')->name('show professions');
                Route::get('/create_profession', 'create')->name('create profession');
                Route::post('/store_profession', 'store')->name('store profession');
                Route::get('/edit_profession/{profession}', 'edit')->name('edit profession');
                Route::post('/update_profession/{profession}', 'update')->name('update profession');
                Route::post('/delete_profession/{profession}', 'destroy')->name('delete profession');
            });
        });

        Route::group(['prefix' => 'partner'], function ($router) {
            Route::group(['controller' => PartnerController::class], function () {
                Route::get('/', 'index')->name('show partners');
                Route::get('/create_partner', 'create')->name('create partner');
                Route::post('/store_partner', 'store')->name('store partner');
                Route::get('/edit_partner/{partner}', 'edit')->name('edit partner');
                Route::post('/update_partner/{partner}', 'update')->name('update partner');
                Route::post('/delete_partner/{partner}', 'destroy')->name('delete partner');
            });
        });

        Route::group(['prefix' => 'tests'], function ($router) {
            Route::group(['controller' => TestController::class], function () {
                Route::get('/', 'index')->name('show tests');
                Route::get('/create_test', 'create')->name('create test');
                Route::post('/store_test', 'store')->name('store test');
                Route::get('/edit_test/{test}', 'edit')->name('edit test');
                Route::post('/update_test/{test}', 'update')->name('update test');
                Route::post('/delete_test/{test}', 'destroy')->name('delete test');
            });
        });

        Route::group(['prefix' => 'hospital'], function ($router) {
            Route::group(['controller' => HospitalController::class], function () {
                Route::get('/', 'index')->name('show hospitals');
                Route::get('/create_hospital', 'create')->name('create hospital');
                Route::post('/store_hospital', 'store')->name('store hospital');
                Route::get('/edit_hospital/{hospital}', 'edit')->name('edit hospital');
                Route::post('/update_hospital/{hospital}', 'update')->name('update hospital');
                Route::post('/delete_hospital/{hospital}', 'destroy')->name('delete hospital');
            });
        });

        Route::group(['prefix' => 'report'], function ($router) {
            Route::group(['controller' => ReportController::class], function () {
                Route::get('/', 'index')->name('show reports');
                Route::get('/answered', 'answered_reports')->name('show answered reports');
                Route::get('/show/{report}', 'show_dashboard')->name('show one report');
                Route::post('/assign_doctor/{report}', 'assign_doctor')->name('assign doctor');
                Route::get('/show_answered/{report}', 'show_answered_dashboard')->name('show answered report');
            });
        });

        Route::group(['prefix' => 'reservation'], function ($router) {
            Route::group(['controller' => ReservationController::class], function () {
                Route::get('/', 'index')->name('show reservations');
                Route::get('/show/{reservation}', 'show_reserved_dashboard')->name('show one reservation');
                Route::post('/reserve/{reservation}', 'reserve')->name('reserve');
            });
        });

        Route::group(['prefix' => 'meeting'], function ($router) {
            Route::group(['controller' => MeetingController::class], function () {
                Route::get('/', 'get_meetings')->name('show meetings');
                Route::get('edit/{meeting}', 'edit')->name('edit meeting');
                Route::post('assign_doctor/{meeting}', 'assign_doctor')->name('assign doctor meeting');
            });
        });
    });
});
