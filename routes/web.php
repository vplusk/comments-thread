<?php

Route::get('/', 'CommentController@index');
Route::get('comments', 'CommentController@getData');
Route::put('comments/{id}', 'CommentController@edit');
Route::delete('comments/{id}', 'CommentController@destroy');
Route::post('comments', 'CommentController@store');

