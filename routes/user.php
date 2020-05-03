<?php

// test for template 
Route::get('/', function () {
    return view('welcome');
});


Auth::Routes();

Route::namespace('User')->group(function(){
    
   

    Route::group(['prefix' => 'user'],function(){

        Route::get('logout', 'UserLoginController@logout')->name('Userlogout');
        
        Route::group(['middleware' => ['user_auth']], function () {

            // Routes Where user will be able to access them if he authenticated 
            
            Route::post('changepassword' , 'ChangePasswordController@ChangePassword');
        
            Route::get('changepassword' , 'ChangePasswordController@showChangePasswordForm')->name('changepassword');
        
            Route::get('home' ,function (){
                return view('home');
            });

            // Routes For the profile of the user
            Route::get('profile' , 'UserHomeController@showprofile');

            Route::get('profile/{userId}/edit', 'UserHomeController@edit');

            Route::put('profile/{userId}', 'UserHomeController@update')->name('UpdateUserr');

            Route::get('profile/photo', 'UserHomeController@changephoto')->name('uploadphoto');

            Route::post('profile/photo', 'UserHomeController@update_avatar');

            Route::get('offers', 'UserHomeController@showOffers');

            Route::get('details/{offerId}', 'UserHomeController@showDetails');

            Route::get('contact-us', 'SupportController@create');

            Route::post('contact-us', 'SupportController@send')->name('Contact-us');
          
        });
    
        // Routes For user to login and register process
    
        Route::get('register', 'UserLoginController@showRegisterForm')->name('registerUserFrom');
    
        Route::post('register', 'UserLoginController@create');
    
        Route::get('login', 'UserLoginController@showLoginForm')->name('loginUserForm');
    
        Route::post('login', 'UserLoginController@Login');

    });

    
});

?>
