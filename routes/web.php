<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;

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
    return view('home');
});

// if verified get dashboard url:
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');



// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function () {

    // custom urls go before resource routes:
//    Route::get('classrooms/{classroom}', [ClassroomController::class, 'test']);

    // @info: https://gyazo.com/b1dcca493538db567a9ec28d3a5fadf3
    Route::resource('classrooms', ClassroomController::class);


});


//Require custom jetstream fortify routing:
require_once('fortify_routes.php');
require_once('jetstream_routes.php');

