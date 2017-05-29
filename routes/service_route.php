<?php

Route::group(['middleware' => ['service.center']], function (){
    View::composer('service_center_cabinet.layouts.sidebar', function($view)
    {
        $service_centers = Auth::user()->service_centers;
        $view->with(['service_centers' => $service_centers]);
    });
    Route::get('cabinet', 'ServiceCenterCabinet\CabinetController@getIndex')->name('cabinet');
    Route::get('cabinet/dashboard', 'ServiceCenterCabinet\CabinetController@getDashboard')->name('cabinet.dashboard');
    Route::get('cabinet/sc/{id}', 'ServiceCenterCabinet\CabinetController@getService')->name('cabinet.service')->where('id', '[0-9]+');
    Route::post('cabinet/sc/{id}/add-logo', 'ServiceCenterCabinet\CabinetController@postAddLogo')->name('cabinet.add.logo.service');
    Route::put ('cabinet/sc/{id}/update', 'ServiceCenterCabinet\CabinetController@putUpdateService')->name('cabinet.update.service')->where('id', '[0-9]+');
    Route::post ('cabinet/sc/{id}/add-personal', 'ServiceCenterCabinet\CabinetController@postAddPersonalService')->name('cabinet.add.personal.service')->where('id', '[0-9]+');
    Route::delete ('cabinet/sc/{id}/delete-personal/{id_person}', 'ServiceCenterCabinet\CabinetController@deletePersonalService')->name('cabinet.delete.personal.service');
    Route::post ('cabinet/sc/{id}/add-photo', 'ServiceCenterCabinet\CabinetController@postAddPhotoService')->name('cabinet.add.photo.service')->where('id', '[0-9]+');
    Route::delete ('cabinet/sc/{id}/delete-photo/{id_photo}', 'ServiceCenterCabinet\CabinetController@deletePhotoService')->name('cabinet.delete.photo.service');

    Route::get('cabinet/add/service', 'ServiceCenterCabinet\CabinetController@getAddService')->name('cabinet.add.service');
    Route::post('cabinet/add/service', 'ServiceCenterCabinet\CabinetController@postAddService')->name('cabinet.add.service');
    Route::get('cabinet/logout', 'ServiceCenterCabinet\CabinetController@getLogout')->name('cabinet.logout');
});
