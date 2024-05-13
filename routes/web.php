<?php
use App\Core\Routing\Route;

Route::get('/list','ListController@index');

Route::post('/list/add','ListController@create');

Route::delete('/list/delete/{id}','ListController@delete');

Route::post('/list/edit/{id}','ListController@update');

Route::post('/list/toggle','ListController@toggle');

//login and register

Route::post('/auth/register','AuthController@register');
Route::post('/auth/login','AuthController@login');

//search 

Route::get('/search/item/{text}','SearchController@search');
