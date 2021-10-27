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

Route::resource('/students', StudentsController::class);
Route::post('/students/update/{id}', 'App\Http\Controllers\StudentsController@update');
Route::post('/students/delete/{id}', 'App\Http\Controllers\StudentsController@destroy');

Route::resource('/courses', CoursesController::class);
Route::post('/courses/update/{id}', 'App\Http\Controllers\CoursesController@update');
Route::post('/courses/delete/{id}', 'App\Http\Controllers\CoursesController@destroy');

Route::resource('/enrollments', EnrollmentsController::class);
Route::post('/enrollments/update/{id}', 'App\Http\Controllers\EnrollmentsController@update');
Route::post('/enrollments/delete/{id}', 'App\Http\Controllers\EnrollmentsController@destroy');

