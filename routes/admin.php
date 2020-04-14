<?php


Auth::Routes();


Route::namespace('Admin')->group(function(){

    // Admin Routes for Login Process

    Route::get('login', 'AdminLoginController@showLoginForm')->name('loginForm');

    Route::post('login', 'AdminLoginController@Login');


    // Routes Where admin will be able to access them if he authenticated 

    Route::group(['middleware' => ['admin_auth']], function () {

        Route::post('changepassword' , 'ChangePasswordController@ChangePassword');

        Route::get('changepassword' , 'ChangePasswordController@showChangePasswordForm')->name('changePassword');

        Route::get('dashboard','AdminHomeController@index');
    });

});

?>