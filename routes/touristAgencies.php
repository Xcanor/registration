<?php

Auth::Routes();

Route::namespace('Agency')->group(function(){

    Route::get('login', 'AgencyLoginController@showLoginForm')->name('loginagency');
    
    Route::post('login', 'AgencyLoginController@Login');


    Route::group(['middleware' => ['agency_auth']], function () {

        Route::get('dashboard','AgencyHomeController@index');

        Route::get('createoffer','AgencyManagementController@create')->name('createoffer');

        Route::post('createoffer','AgencyManagementController@store');
        
        Route::get('dashboard/{offerId}', 'AgencyManagementController@show'); 

        Route::get('dashboard/{offerId}/edit', 'AgencyManagementController@edit');

        Route::put('dashboard/{offerId}', 'AgencyManagementController@update')->name('UpdateOffer');

        Route::delete('dashboard/{offerId}','AgencyManagementController@destroy');

        Route::get('dashboard/{offerId}/add','AgencyManagementController@add')->name('add_detail');

        Route::post('dashboard/{offerId}/add','AgencyManagementController@save');

        Route::get('dashboard/details/{offerId}','AgencyManagementController@showdetails')->name('show_detail');

    




    });
});