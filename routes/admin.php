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

        // Routes for Administration Management
        Route::get('pages/dashboard','AdminHomeController@index');

        Route::get('pages/dashboard/{userId}', 'AdminManagementController@show');

        Route::get('createUser', 'AdminManagementController@create')->name('AddUser');

        Route::post('createUser', 'AdminManagementController@store');

        Route::get('pages/dashboard/{userId}/edit', 'AdminManagementController@edit');

        Route::put('pages/dashboard/{userId}', 'AdminManagementController@update')->name('UpdateUser');

        Route::delete('pages/dashboard/{userId}','AdminManagementController@destroy');

        Route::get('/status/update' , 'AdminManagementController@updateStatus')->name('users.update.status');
    });

});

?>