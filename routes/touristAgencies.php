<?php

Auth::Routes();

Route::namespace('Agency')->group(function(){

    Route::get('login', 'AgencyLoginController@showLoginForm')->name('loginagency');
    
    Route::post('login', 'AgencyLoginController@Login');

    Route::get('logout', 'AgencyLoginController@logout')->name('Agencylogout');


    Route::group(['middleware' => ['agency_auth']], function () {

        Route::get('dashboard','AgencyHomeController@index');

        // Routes for Offers Management
        Route::get('createoffer','OffersController@create')->name('createoffer');

        Route::post('createoffer','OffersController@store');
        
        Route::get('dashboard/{offerId}', 'OffersController@show'); 

        Route::get('dashboard/{offerId}/edit', 'OffersController@edit');

        Route::put('dashboard/{offerId}', 'OffersController@update')->name('UpdateOffer');

        Route::delete('dashboard/{offerId}','OffersController@destroy');

        Route::get('/status/offer' , 'OffersController@updateStatusOffer')->name('offers.update.status');



        // Routes for Offer Details Management

        Route::get('dashboard/{offerId}/add','OffersDetailController@add')->name('add_detail');

        Route::post('dashboard/{offerId}/add','OffersDetailController@save');

        Route::get('dashboard/details/{offerId}','OffersDetailController@showdetails')->name('show_detail');

        Route::get('dashboard/details/{detailId}/edit','OffersDetailController@editDetails');

        Route::put('dashboard/details/{detailId}', 'OffersDetailController@updateDetails')->name('UpdateDetails');

        Route::delete('dashboard/details/{detailId}','OffersDetailController@destroy');

    




    });
});