<?php

Route::get('/', function () {

    return view('welcome');
});

Auth::Routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Admin\AdminController@showAdminLoginForm')->name('loginForm');

Route::post('admin/login', 'Admin\AdminController@adminLogin');

Route::get('admin/dashboard' , function(){
        return view('auth.admin.dashboard',[
            'admins' => App\Admin::all()],[
            'users' => App\User::all()]);
})->middleware('auth');


?>