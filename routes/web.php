<?php

Route::get('/', 'HomeController@index');
Route::post('login', 'Auth\AuthController@login');
