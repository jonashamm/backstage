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

Route::get('songcast/add/{song_id}/{instrument_id}/{user_id}','SongcastsController@add');
Route::resource('songcasts', 'SongcastsController');
Route::get('/artisan/migrate1slug-8490x','DBController@migrate');

Route::delete('casts/{user_id}/{instrument_id}','CastsController@destroy');
Route::resource('icons', 'IconsController');
Route::resource('attachmenttypes', 'AttachmenttypesController');