<?php
Route::group(['prefix' => '/v1/author', 'as' => 'author-v1'], function () {
    Route::post('/', 'AuthorController@store');
});

