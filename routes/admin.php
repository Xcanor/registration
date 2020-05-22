<?php


Auth::Routes();


Route::namespace('Admin')->group(function(){

    // Admin Routes for Login Process

    Route::get('login', 'AdminLoginController@showLoginForm')->name('loginForm');

    Route::post('login', 'AdminLoginController@Login');

    Route::get('logout', 'AdminLoginController@logout')->name('Adminlogout');


    // Routes Where admin will be able to access them if he authenticated 

    Route::group(['middleware' => ['admin_auth']], function () {

        Route::post('changepassword' , 'ChangePasswordController@ChangePassword');

        Route::get('changepassword' , 'ChangePasswordController@showChangePasswordForm')->name('changePassword');

        // Routes for Administration Management
        Route::get('dashboard','AdminHomeController@welcome');

        Route::get('dashboard/offer','AdminHomeController@showOffers');
        
        Route::get('dashboard/users','AdminHomeController@showUsers');

        Route::get('dashboard/agency','AdminHomeController@showAgencies');

        

             
        // Routes for Users (Normall) Managemrnt
        Route::get('dashboard/users/{userId}', 'AdminManagementController@show');

        Route::get('createUser', 'AdminManagementController@create')->name('AddUser');

        Route::post('createUser', 'AdminManagementController@store');

        Route::get('dashboard/users/{userId}/edit', 'AdminManagementController@edit');

        Route::put('dashboard/users/{userId}', 'AdminManagementController@update')->name('UpdateUser');

        Route::delete('dashboard/users/{userId}','AdminManagementController@destroy');

        Route::get('/status/update' , 'AdminManagementController@updateStatus')->name('users.update.status');
        

        // Routes For Offer Management
        Route::get('dashboard/offer/{offerId}', 'OffersController@viewOffer');

        Route::get('createoffer','OffersController@create')->name('createofferr');

        Route::post('createoffer','OffersController@storeoffer');

        Route::group(['prefix' => 'dashboard'], function () {

            Route::get('offer/{offerId}/edit', 'OffersController@edit');

            Route::put('offer/{offerId}', 'OffersController@update')->name('UpdateOfferr');

            Route::delete('offer/{offerId}','OffersController@destroy');

        });
        Route::get('/statuss/offer' , 'OffersController@updateStatusOffer')->name('offers.update.status');

        
        // Routes For Agency Users Management
        Route::get('dashboard/agencies/{agencyId}', 'AgenciesController@showAgency');

        Route::get('addagency','AgenciesController@createAgency')->name('AddAgency');
        
        Route::post('addagency', 'AgenciesController@saveAgency');

        Route::group(['prefix' => 'dashboard'], function () {
            
            Route::get('agencies/{agencyId}/edit', 'AgenciesController@editAgency');

            Route::put('agencies/{agencyId}', 'AgenciesController@updateAgency')->name('UpdateAgency');
    
            Route::delete('agencies/{agencyId}','AgenciesController@destroyAgency');
        });

        Route::get('/status/agency' , 'AgenciesController@updateStatusAgency')->name('agencies.update.status');


        // Routes For Details associated with offers
        Route::group(['prefix' => 'dashboard'], function () {
            
            Route::get('offer/{offerId}/add','DetailsController@addDetails')->name('add_details');

            Route::post('offer/{offerId}/add','DetailsController@save');

            Route::get('offer/details/{offerId}','DetailsController@showDetails');

            Route::get('offer/details/{detailId}/edit','DetailsController@editDetails');

            Route::put('offer/details/{detailId}', 'DetailsController@updateDetails')->name('UpdateDetail');

            Route::delete('offer/details/{detailId}','DetailsController@destroy');
        });

        Route::group(['prefix' => 'dashboard'],function () {

            Route::get('support', 'SupportController@index');

            Route::get('details/{detailId}', 'SupportController@show');
        });

        Route::get('/status/message' , 'SupportController@messageUpdateStatus')->name('message.update.status');

    });

});

?>