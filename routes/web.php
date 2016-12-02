<?php

View::share('baseurl',URL::to('/'));
View::share('active_user', Auth::user());

Route::get('/', 'SongsController@index');

Route::resource('songs','SongsController');
Route::resource('instruments','InstrumentsController');
Route::resource('users','UsersController');
Route::resource('attachments','AttachmentsController');

Auth::routes();

Route::get('api/instruments','InstrumentsController@indexAPI');
Route::get('api/song/{song_id}','SongsController@showAPI');

Route::get('song-cast-add/{song_id}/{instrument_id}/{user_id}','SongsController@addCast');
Route::resource('songcasts', 'SongcastsController');