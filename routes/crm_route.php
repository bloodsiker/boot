<?php

Route::group(['middleware' => 'crm'], function () {
    Route::group(['prefix' => 'crm-panel'], function () {
        Route::get('/', 'Crm\CrmController@getCabinet')->name('crm.cabinet');
        Route::get('/logout', 'Crm\CrmController@getLogout')->name('crm.logout');

        Route::get('/request', 'Crm\RequestScController@getIndex')->name('crm.request');
        Route::post('/request/edit', 'Crm\RequestScController@postRequestEdit')->name('crm.request.edit');
        Route::get('/request/info', 'Crm\RequestScController@getRequestInfo')->name('crm.request.info');

        Route::get('/help-request', 'Crm\RequestHelpController@getIndex')->name('crm.help.request');
    });
});