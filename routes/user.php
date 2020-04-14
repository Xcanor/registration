<?php

Route::get('/', function () {
    return view('welcome');
});


Route::view('/home', 'HomeController@index')->middleware('auth');

Auth::Routes();

Route::namespace('User')->group(function(){
    

    Route::group(['prefix' => 'user'],function(){

        Route::group(['middleware' => ['user_auth']], function () {

            // Routes Where user will be able to access them if he authenticated 
            
            Route::post('changepassword' , 'ChangePasswordController@ChangePassword');
        
            Route::get('changepassword' , 'ChangePasswordController@showChangePasswordForm')->name('changepassword');
        
            Route::get('home' ,function (){
                return view('home');
            });
          
        });
    
        // Routes For user to login and register process
    
        Route::get('register', 'UserLoginController@showRegisterForm')->name('registerUserFrom');
    
        Route::post('register', 'UserLoginController@create');
    
        Route::get('login', 'UserLoginController@showLoginForm')->name('loginUserForm');
    
        Route::post('login', 'UserLoginController@Login');

    });

    
});

?>
