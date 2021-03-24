<?php

Route::group(['prefix' => 'book', 'as' => 'book-v1'], function () {
    Route::get('/', 'BookController@index');
    Route::get('/{id?}', 'BookController@show');
    Route::put('/{id?}', 'BookController@update');
    Route::post('/', 'BookController@store');
    Route::get('/getBooksByAuthorId/{id?}', 'BookController@getBooksByAuthorId');
});

