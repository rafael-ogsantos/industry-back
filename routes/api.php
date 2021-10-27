<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EnrollmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'students'], function () {
    Route::resource('/', StudentsController::class);
    Route::post('/update/{id}', 'App\Http\Controllers\StudentsController@update');
    Route::post('/delete/{id}', 'App\Http\Controllers\StudentsController@destroy');
});

Route::group(['prefix' => 'courses'], function () {
    Route::resource('/', CoursesController::class);
    Route::post('/update/{id}', 'App\Http\Controllers\CoursesController@update');
    Route::post('/delete/{id}', 'App\Http\Controllers\CoursesController@destroy');
});

Route::group(['prefix' => 'enrollments'], function () {
    Route::resource('/', EnrollmentsController::class);
    Route::post('/update/{id}', 'App\Http\Controllers\EnrollmentsController@update');
    Route::post('/delete/{id}', 'App\Http\Controllers\EnrollmentsController@destroy');
});
