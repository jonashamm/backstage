<?php

View::share('baseurl',URL::to('/'));

Route::get('/', 'SongsController@index');
Route::get('/songs', 'SongsController@index');
Route::get('/song/{song_id}', 'SongsController@show');
Route::post('/song/create', 'SongsController@create');
Route::post('/song/update/{song_id}', 'SongsController@update');
Route::post('/song/delete/{song_id}', 'SongsController@destroy');
