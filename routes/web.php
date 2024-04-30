<?php
use App\Core\Routing\Route;

Route::get('/a/{asd}','HomeController@index');
Route::get('/b/{slug}','HomeController@index');