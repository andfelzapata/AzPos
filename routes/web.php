<?php


Route::get('/', function () {

    return view('home');

});

Route::post('login', 'Auth\LoginController@login');
