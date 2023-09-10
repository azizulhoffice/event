<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

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

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth','check-admin']], function () {
        Route::resource('roles', 'RoleController');
        Route::resource('users', 'UserController');
        Route::resource('participants', 'ParticipantController');
        Route::resource('events', 'EventController');
        Route::any('score/create', [App\Http\Controllers\EventController::class,'scoreCreate'])->name('score.create');
});

Route::group(['prefix' => 'judge', 'middleware' => ['auth','check-judge'], 'as' => 'judge.'], function () {
    Route::get('/','JudgeController@index');
    Route::get('event/{id}/score','JudgeController@eventScore')->name('event.score');
    // Route::resource('roles', 'RoleController');
    // Route::resource('users', 'UserController');
    // Route::resource('participants', 'ParticipantController');
    // Route::resource('events', 'EventController');
    // Route::any('score/create', [App\Http\Controllers\EventController::class,'scoreCreate'])->name('score.create');
});