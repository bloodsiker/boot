<?php

Route::group(['middleware' => 'seo'], function () {
    Route::group(['prefix' => 'seo'], function (){
        Route::get('/dashboard', 'Seo\SeoController@getCabinet')->name('seo.cabinet.dashboard');
        Route::get('/logout', 'Seo\SeoController@getLogout')->name('seo.logout');


        Route::get('/pages', 'Seo\PageController@getIndex')->name('admin.pages');
        Route::get('/page/edit/{id}', 'Seo\PageController@getEdit')->name('admin.page.edit');
        Route::post('/page/edit/{id}', 'Seo\PageController@postEdit')->name('admin.page.edit');
    });
});
