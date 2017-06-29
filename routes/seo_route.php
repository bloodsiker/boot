<?php

Route::group(['middleware' => 'seo'], function () {
    Route::group(['prefix' => 'seo'], function (){
        Route::get('/dashboard', 'Seo\SeoController@getCabinet')->name('seo.cabinet.dashboard');
        Route::get('/pages', 'Seo\SeoController@getPages')->name('admin.pages');


        Route::get('/page/edit/{id}', 'Seo\PageController@getEdit')->name('admin.page.edit');
        Route::post('/page/edit/{id}', 'Seo\PageController@postEdit')->name('admin.page.edit');



        Route::get('/profile', 'Seo\ProfileController@getIndex')->name('seo.profile');
        Route::put('/profile', 'Seo\ProfileController@getIndex')->name('seo.profile.update');
        Route::get('/logout', 'Seo\SeoController@getLogout')->name('seo.logout');
    });
});
