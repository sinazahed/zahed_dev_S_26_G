<?php
use App\Core\Routing\Route;

Route::get('/api/v1/list','Api\V1\ListController@index');

Route::post('/api/v1/list/add','Api\V1\ListController@create');

Route::delete('/api/v1/list/delete/{id}','Api\V1\ListController@delete');

Route::post('/api/v1/list/edit/{id}','Api\V1\ListController@update');
