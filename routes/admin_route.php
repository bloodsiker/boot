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

        Route::get('/street', 'Admin\StreetController@getIndex')->name('admin.street');
        Route::post('/street/create', 'Admin\StreetController@postStreetCreate')->name('admin.street.create');

        Route::get('/pages', 'Admin\PageController@getIndex')->name('admin.pages');
        Route::get('/page/edit/{id}', 'Admin\PageController@getEdit')->name('admin.page.edit');
        Route::post('/page/edit/{id}', 'Admin\PageController@postEdit')->name('admin.page.edit');
    });
});
