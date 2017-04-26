<?php

Route::group(['middleware' => 'crm'], function () {
    Route::group(['prefix' => 'crm-panel'], function () {
        Route::get('/', 'Crm\CrmController@getCabinet')->name('crm.cabinet');
        Route::get('/logout', 'Crm\CrmController@getLogout')->name('crm.logout');

        Route::get('/request', 'Crm\RequestController@getIndex')->name('crm.request');
        Route::post('/request/edit', 'Crm\RequestController@postRequestEdit')->name('crm.request.edit');
        Route::get('/request/info', 'Crm\RequestController@getRequestInfo')->name('crm.request.info');
    });
});