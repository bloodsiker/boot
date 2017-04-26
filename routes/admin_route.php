<?php

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin-panel'], function (){
        Route::get('/', 'Admin\AdminController@getCabinet')->name('admin.cabinet');
        Route::get('/logout', 'Admin\AdminController@getLogout')->name('admin.logout');

        Route::get('/users', 'Admin\UserController@getIndex')->name('admin.users');
        Route::get('/user/create', 'Admin\UserController@getUserCreate')->name('admin.user.create');
        Route::post('/user/create', 'Admin\UserController@postUserCreate')->name('admin.user.create');
        Route::get('/user/delete/{user_id}', 'Admin\UserController@getUserDelete')->name('admin.user.delete');
        Route::get('/user/edit/{user_id}', 'Admin\UserController@getUserEdit')->name('admin.user.edit');
        Route::post('/user/edit/{user_id}', 'Admin\UserController@postUserEdit')->name('admin.user.edit');

        Route::get('/city', 'Admin\CityController@getIndex')->name('admin.city');
        Route::post('/city/create', 'Admin\CityController@postCityCreate')->name('admin.city.create');
    });
});
