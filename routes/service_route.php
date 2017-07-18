<?php

Route::group(['middleware' => ['service.center']], function (){

    Route::get('cabinet', 'ServiceCenterCabinet\CabinetController@getIndex')->name('cabinet');
    Route::get('cabinet/dashboard', 'ServiceCenterCabinet\CabinetController@getDashboard')->name('cabinet.dashboard');
    Route::get('cabinet/dashboard_stat', 'ServiceCenterCabinet\CabinetController@getDashboardStat')->name('cabinet.dashboard.stat');
    Route::get('cabinet/settings', 'ServiceCenterCabinet\CabinetController@getSettings')->name('cabinet.settings');
    Route::post('cabinet/settings', 'ServiceCenterCabinet\CabinetController@postSettings')->name('cabinet.settings');

    Route::get('cabinet/sc/{id}', 'ServiceCenterCabinet\CabinetController@getService')->name('cabinet.service')->where('id', '[0-9]+');
    Route::post('cabinet/sc/{id}/add-logo', 'ServiceCenterCabinet\CabinetController@postAddLogo')->name('cabinet.add.logo.service');
    Route::put ('cabinet/sc/{id}/update', 'ServiceCenterCabinet\CabinetController@putUpdateService')->name('cabinet.update.service')->where('id', '[0-9]+');
    Route::post ('cabinet/sc/{id}/add-personal', 'ServiceCenterCabinet\CabinetController@postAddPersonalService')->name('cabinet.add.personal.service')->where('id', '[0-9]+');
    Route::delete ('cabinet/sc/{id}/delete-personal/{id_person}', 'ServiceCenterCabinet\CabinetController@deletePersonalService')->name('cabinet.delete.personal.service');
    Route::post ('cabinet/sc/{id}/add-photo', 'ServiceCenterCabinet\CabinetController@postAddPhotoService')->name('cabinet.add.photo.service')->where('id', '[0-9]+');
    Route::delete ('cabinet/sc/{id}/delete-photo/{id_photo}', 'ServiceCenterCabinet\CabinetController@deletePhotoService')->name('cabinet.delete.photo.service');
    Route::put ('cabinet/sc/{id}/disabled', 'ServiceCenterCabinet\CabinetController@disabledService')->name('cabinet.disabled.service');
    Route::put ('cabinet/sc/{id}/enabled', 'ServiceCenterCabinet\CabinetController@enabledService')->name('cabinet.enabled.service');
    Route::get ('cabinet/sc/list-disabled', 'ServiceCenterCabinet\CabinetController@listDisabledService')->name('cabinet.list-disabled.service');

    Route::get ('cabinet/messages', 'ServiceCenterCabinet\UserRequestController@getMessages')->name('cabinet.messages');
    Route::put ('cabinet/messages', 'ServiceCenterCabinet\UserRequestController@putMessages')->name('cabinet.messages');
    Route::get ('cabinet/open/message', 'ServiceCenterCabinet\UserRequestController@openMessage')->name('cabinet.open.message');
    Route::get ('cabinet/requests', 'ServiceCenterCabinet\UserRequestController@allRequest')->name('cabinet.requests');
    Route::get ('cabinet/request/change_status', 'ServiceCenterCabinet\UserRequestController@changeStatus')->name('cabinet.request.change_status');

    Route::get('cabinet/add/service', 'ServiceCenterCabinet\CabinetController@getAddService')->name('cabinet.add.service');
    Route::post('cabinet/add/service', 'ServiceCenterCabinet\CabinetController@postAddService')->name('cabinet.add.service');
    Route::get('cabinet/logout', 'ServiceCenterCabinet\CabinetController@getLogout')->name('cabinet.logout');

    Route::group(['middleware' => ['admin']], function (){
        Route::get('cabinet/admin/user-list', 'ServiceCenterCabinet\AdminCabinetController@getUserList')->name('cabinet.admin.user.list');
        Route::get('cabinet/admin/user/{id}/list-sc', 'ServiceCenterCabinet\AdminCabinetController@getUserListSc')->name('cabinet.admin.user.list.sc');
        Route::get('cabinet/admin/list-sc', 'ServiceCenterCabinet\AdminCabinetController@getListSc')->name('cabinet.admin.list.sc');
        Route::get('cabinet/admin/sc/{id}', 'ServiceCenterCabinet\AdminCabinetController@getService')->name('cabinet.admin.service')->where('id', '[0-9]+');
        Route::put ('cabinet/admin/sc/{id}/update', 'ServiceCenterCabinet\AdminCabinetController@putUpdateService')->name('cabinet.admin.update.service')->where('id', '[0-9]+');
        Route::post ('cabinet/admin/sc/{id}/add-personal', 'ServiceCenterCabinet\AdminCabinetController@postAddPersonalService')->name('cabinet.admin.add.personal.service')->where('id', '[0-9]+');
        Route::delete ('cabinet/admin/sc/{id}/delete-personal/{id_person}', 'ServiceCenterCabinet\AdminCabinetController@deletePersonalService')->name('cabinet.admin.delete.personal.service');
        Route::post ('cabinet/admin/sc/{id}/add-photo', 'ServiceCenterCabinet\AdminCabinetController@postAddPhotoService')->name('cabinet.admin.add.photo.service')->where('id', '[0-9]+');
        Route::delete ('cabinet/admin/sc/{id}/delete-photo/{id_photo}', 'ServiceCenterCabinet\AdminCabinetController@deletePhotoService')->name('cabinet.admin.delete.photo.service');
        Route::get ('cabinet/admin/messages', 'ServiceCenterCabinet\AdminCabinetController@getMessages')->name('cabinet.admin.messages');
        Route::get ('cabinet/admin/requests', 'ServiceCenterCabinet\AdminCabinetController@allRequest')->name('cabinet.admin.requests');
    });
});
