<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommunityController;
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

// Default home route:
//Route::any('/', function () {
//    return view('home');
//});

// Default home route:
Route::get('/home', function () {
    return view('home');
});


// if verified get dashboard url:
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Only authenticated users may access this route...
Route::group(['middleware' => 'auth'], function () {

    // if signed in:
    Route::get('/', function () {
        return view('dashboard');
    });

    // custom urls go before resource routes:
    // Route::get('classrooms/{classroom}', [ClassroomController::class, 'test']);

    // @info: https://gyazo.com/b1dcca493538db567a9ec28d3a5fadf3
    route::get('/classrooms/search', [ClassroomController::class, 'searchClassrooms']);
    route::get('/explore', [CommunityController::class, 'index']);

    Route::resource('classrooms', ClassroomController::class);

    // use prefix for subjects:
    Route::group(['middelware' => 'classrooms', 'prefix' => 'classrooms/{classroom_id}'], function() {

        // register chat route:
        Route::post('chat', [MessageController::class, 'store'], ['classroom_id' => '{classroom_id}']);

        // subjects needs Classroom parameter:
        Route::resource('subjects', SubjectsController::class);

        Route::group(['middelware' => 'subjects', 'prefix' => 'subjects/{subject_id}'], function() {
            Route::resource('notes', NotesController::class);
        });
    });

    Route::resource('history-overview', UserHistoryController::class)->only('index', 'show', 'destroy');
});


//Require custom jetstream fortify routing:
require_once('fortify_routes.php');
require_once('jetstream_routes.php');

