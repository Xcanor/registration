<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::Routes();

// Admin Routes for Login Process

Route::get('admin/login', 'Admin\AdminController@showAdminLoginForm')->name('loginForm');

Route::post('admin/login', 'Admin\AdminController@adminLogin');

// Routes Where admin will be able to access them if he authenticated 

Route::group(['middleware' => ['admin']], function () {

    Route::post('admin/changepassword' , 'Admin\ChangePasswordController@ChangePassword');

    Route::get('admin/changepassword' , 'Admin\ChangePasswordController@showChangePasswordForm')->name('changepassword');

    Route::get('admin/dashboard' , function(){
            return view('auth.admin.dashboard',[
                'admins' => App\Admin::all()],[
                'users' => App\User::all()]);
            });
});






?>