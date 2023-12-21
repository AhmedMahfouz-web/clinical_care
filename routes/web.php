<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfessionController;
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
        Route::get('/', function () {
            return view('layouts.dashboard');
        })->name('dashboard');

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
        Route::get('/initial-meetings', [MeetingController::class, 'getInitialMeetings']);
    });
});
