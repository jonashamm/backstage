<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

View::share('baseurl',URL::to('/'));

Route::get('/', function () {
    return view('welcome');
});

Route::get('/songs/', 'SongsController@index');
Route::get('/song/{song_id}', 'SongsController@show');
Route::post('/song/create', 'SongsController@create');
Route::post('/song/update/{song_id}', 'SongsController@update');
Route::post('/song/delete/{song_id}', 'SongsController@destroy');