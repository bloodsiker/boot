<?php

Route::group(['middleware' => ['service.center']], function (){
    Route::get('cabinet', 'ServiceCenterCabinet\CabinetController@getIndex')->name('cabinet');
    Route::get('cabinet/dashboard', 'ServiceCenterCabinet\CabinetController@getDashboard')->name('cabinet.dashboard');
    Route::get('cabinet/sc/{id}', 'ServiceCenterCabinet\CabinetController@getService')->name('cabinet.service')->where('id', '[0-9]+');
    Route::get('cabinet/add/service', 'ServiceCenterCabinet\CabinetController@getAddService')->name('cabinet.add.service');
    Route::get('cabinet/logout', 'ServiceCenterCabinet\CabinetController@getLogout')->name('cabinet.logout');
});
