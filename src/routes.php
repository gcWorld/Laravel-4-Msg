<?php

//Bind route parameter
Route::model('msg','Msg');

Route::group(array('prefix' => 'msg', 'before' => 'auth'), function()
{

//Show pages
Route::get('/inbox', 'MsgsController@index');
Route::get('/outbox', 'MsgsController@index_outbox');
Route::get('/delete/{msg}', 'MsgsController@delete');

//handle form submissions
Route::post('/new', 'MsgsController@handleCreate');
Route::post('/delete', 'MsgsController@handleDelete');

});