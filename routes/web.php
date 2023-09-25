<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    // return view('welcome');
    $role = Auth::check() ? Auth::user()->role : '';
    if ($role == 'admin' || $role == 'event-manager') {
        return redirect('/admin');
    } else if ($role == 'judge') {
        return redirect('/judge');
    } else if ($role == 'user') {
        return view('welcome');
    } else {
        return redirect('/login');
    }
});


Route::get('/optimize', function () {
    Artisan::call('optimize');
    echo 'Optimized Successfully';
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    echo 'Migrated Successfully';
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['check-admin']], function () {
        Route::resource('users', 'UserController');
        Route::any('events/{id}/result/unpublish', 'EventController@resultUnpublish')->name('events.result-unpublish');
        Route::any('events/{id}/result/publish', 'EventController@resultPublish')->name('events.result-publish');
        Route::any('all-judges','UserController@allJudges')->name('all-judges');
    });
    Route::group(['middleware' => ['check-event-manager']], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('participants', 'ParticipantController');
        Route::resource('events', 'EventController');
        Route::post('/events/{id}/visibility/toggle', 'EventController@toggleVisibility')->name('events.toggle-visibility');
        Route::any('events/{id}/result', 'EventController@result')->name('events.result');
        Route::any('events/{id}/participant', 'EventController@participantList')->name('events.participant');
        Route::any('events/{id}/marksheet', 'EventController@marksheet')->name('events.marksheet');
        Route::any('events/{event}/judge/marksheet', 'EventController@judgeMarksheet')->name('events.judge.marksheet');
        Route::get('/bulk-score-update','EventController@bulkScore')->name('events.bulk-score');
        Route::post('/bulk-score-update','EventController@bulkScoreUpdate')->name('events.bulk-score.update');
    });
});

Route::group(['prefix' => 'judge', 'middleware' => ['auth', 'check-judge'], 'as' => 'judge.'], function () {
    Route::get('/', 'JudgeController@index')->name('index');
    Route::get('event/{id}/score', 'JudgeController@eventScore')->name('event.score');
    Route::get('event/{id}/score/data', 'JudgeController@getScoreDataForEvent')->name('event.score-data');
    Route::resource('scores', 'ScoreController');
    Route::post('/mark/absent', 'ScoreController@absentStore')->name('participant.absent');
});
Route::get('/participants/sample', 'ParticipantController@excelSample')->name('participants.sample');
