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
        Route::get('dashboard','AdminHomeController@welcome');

        Route::get('dashboard/agency','AdminHomeController@showAgencyPanel');
        
        Route::get('dashboard/users','AdminHomeController@index');

             
        // Routes for Users (Normall) Managemrnt
        Route::get('dashboard/users/{userId}', 'AdminManagementController@show');

        Route::get('createUser', 'AdminManagementController@create')->name('AddUser');

        Route::post('createUser', 'AdminManagementController@store');

        Route::get('dashboard/users/{userId}/edit', 'AdminManagementController@edit');

        Route::put('dashboard/users/{userId}', 'AdminManagementController@update')->name('UpdateUser');

        Route::delete('dashboard/users/{userId}','AdminManagementController@destroy');

        Route::get('/status/update' , 'AdminManagementController@updateStatus')->name('users.update.status');
        

        // Routes For Offer Management
        Route::get('dashboard/agency/{offerId}', 'AdminAgencyManagementController@viewOffer');

        Route::get('createoffer','AdminAgencyManagementController@create')->name('createofferr');

        Route::post('createoffer','AdminAgencyManagementController@storeoffer');

        Route::group(['prefix' => 'dashboard'], function () {

            Route::get('agency/{offerId}/edit', 'AdminAgencyManagementController@edit');

            Route::put('agency/{offerId}', 'AdminAgencyManagementController@update')->name('UpdateOfferr');

            Route::delete('agency/{offerId}','AdminAgencyManagementController@destroy');

        });

        
        // Routes For Agency Users Management
        Route::get('dashboard/agencies/{agencyId}', 'AdminManagementController@showAgency');

        Route::get('addagency','AdminManagementController@createAgency')->name('AddAgency');
        
        Route::post('addagency', 'AdminManagementController@saveAgency');

        Route::group(['prefix' => 'dashboard'], function () {
            
            Route::get('agencies/{agencyId}/edit', 'AdminManagementController@editAgency');

            Route::put('agencies/{agencyId}', 'AdminManagementController@updateAgency')->name('UpdateAgency');
    
            Route::delete('agencies/{agencyId}','AdminManagementController@destroyAgency');
        });

        Route::get('/status/agency' , 'AdminManagementController@updateStatusAgency')->name('agencies.update.status');

        Route::get('/statuss/offer' , 'AdminAgencyManagementController@updateStatusOffer')->name('offers.update.status');

       


        // Routes For Details associated with offers
        Route::group(['prefix' => 'dashboard'], function () {
            
            Route::get('agency/{offerId}/add','AdminAgencyManagementController@addDetails')->name('add_details');

            Route::post('agency/{offerId}/add','AdminAgencyManagementController@save');

            Route::get('agency/details/{offerId}','AdminAgencyManagementController@showDetails');
        });
        

        

    });

});

?>