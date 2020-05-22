<?php
        
Auth::Routes();

Route::namespace('Categories')->group(function(){
    
    //Routes For Category Management
    Route::group(['prefix' => 'admin/dashboard'], function () {
        
        Route::get('category','CategoryController@index');

        Route::get('category/create', 'CategoryController@create')->name('AddCategory');

        Route::post('category/create', 'CategoryController@store');

        Route::get('category/{categoryId}', 'CategoryController@show');

        Route::get('category/{categoryId}/edit', 'CategoryController@edit');

        Route::put('category/{categoryId}', 'CategoryController@update')->name('UpdateCategory');

        Route::get('category/{categoryId}/add', 'CategoryController@addItem')->name('AddItem');

        Route::post('category/{categoryId}/add', 'CategoryController@storeItem');

        Route::delete('category/{categoryId}','CategoryController@destroy')->name('delete.category');
    });
    



});