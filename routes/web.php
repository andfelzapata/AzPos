<?php

Route::get('/', 'HomeController@index');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
