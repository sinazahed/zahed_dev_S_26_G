<?php
use App\Core\Routing\Route;

Route::get('/api/v1/list','Api\V1\ListController@index');

Route::post('/api/v1/list/add','Api\V1\ListController@create');

Route::delete('/api/v1/list/delete/{id}','Api\V1\ListController@delete');

Route::post('/api/v1/list/edit/{id}','Api\V1\ListController@update');


//Login and Registter

Route::post('/api/v1/auth/register','Api\V1\AuthController@register');

Route::post('/api/v1/auth/login','Api\V1\AuthController@login');

Route::get('/api/v1/search/item/{text}','Api\v1\SearchController@search');