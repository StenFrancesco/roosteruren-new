<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test_bart', function () {
    return view('test/bart');
});
Route::get('/test_sten', function () {
    return view('test/sten');
});



Route::get('rooster', [\App\Http\Controllers\RoosterController::class, 'index']);

Route::apiResource('afdelingen', \App\Http\Controllers\AfdelingController::class);
Route::apiResource('roosteritems', \App\Http\Controllers\RoosterItemController::class);
Route::get('userday', [\App\Http\Controllers\UserDayController::class, 'index']);
Route::get('dayinfo', [\App\Http\Controllers\DayInfoController::class, 'index']);
Route::get('users/login/{id}', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('users/logout', [\App\Http\Controllers\UserController::class, 'logout']);
Route::get('afdelingen/users/{id}', [\App\Http\Controllers\AfdelingController::class, 'users']);