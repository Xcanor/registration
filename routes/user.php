<?php

Route::get('/', function () {

    return view('welcome');
});

Auth::Routes();

Route::get('user/register', 'User\UserController@showUserRegisterForm')->name('registerUserFrom');

Route::post('user/register', 'User\UserController@createUser');

Route::get('user/login', 'User\UserController@showUserLoginForm')->name('loginUserForm');

Route::post('user/login', 'User\UserController@userLogin');

?>
