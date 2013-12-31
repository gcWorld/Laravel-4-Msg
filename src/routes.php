<?php

//Bind route parameter
Route::model('msg','Msg');

Route::pattern('msg', '[0-9]+');

Route::group(array('prefix' => 'msg', 'before' => 'auth'), function()
{

//Show pages
Route::get('/inbox', 'MsgsController@index');
Route::get('/outbox', 'MsgsController@index_outbox');
Route::get('/new', 'MsgsController@create');
Route::get('/show/{msg}', 'MsgsController@getMsg');
Route::get('/show/sent/{msg}', 'MsgsController@getSentMsg');
Route::get('/reply/{msg}', 'MsgsController@reply');
Route::get('/delete/{msg}', 'MsgsController@delete');
Route::get('/new/users.json', 'MsgsController@data');

//handle form submissions
Route::post('/new', 'MsgsController@handleCreate');
Route::post('/delete', 'MsgsController@handleDelete');

});

