<?php

Route::group(['middleware' => ['service.center']], function (){
    Route::group(['prefix' => 'cabinet'], function () {

        Route::get('/', 'ServiceCenterCabinet\CabinetController@getIndex')->name('cabinet');
        Route::get('dashboard', 'ServiceCenterCabinet\CabinetController@getDashboard')->name('cabinet.dashboard');
        Route::get('dashboard_stat', 'ServiceCenterCabinet\CabinetController@getDashboardStat')->name('cabinet.dashboard.stat');
        Route::get('settings', 'ServiceCenterCabinet\CabinetController@getSettings')->name('cabinet.settings');
        Route::post('settings', 'ServiceCenterCabinet\CabinetController@postSettings')->name('cabinet.settings');

        Route::get('sc/{id}', 'ServiceCenterCabinet\CabinetController@getService')->name('cabinet.service')->where('id', '[0-9]+');
        Route::post('sc/{id}/add-logo', 'ServiceCenterCabinet\CabinetController@postAddLogo')->name('cabinet.add.logo.service');
        Route::put ('sc/{id}/update', 'ServiceCenterCabinet\CabinetController@putUpdateService')->name('cabinet.update.service')->where('id', '[0-9]+');
        Route::post ('sc/{id}/add-personal', 'ServiceCenterCabinet\CabinetController@postAddPersonalService')->name('cabinet.add.personal.service')->where('id', '[0-9]+');
        Route::delete ('sc/{id}/delete-personal/{id_person}', 'ServiceCenterCabinet\CabinetController@deletePersonalService')->name('cabinet.delete.personal.service');
        Route::post ('sc/{id}/add-photo', 'ServiceCenterCabinet\CabinetController@postAddPhotoService')->name('cabinet.add.photo.service')->where('id', '[0-9]+');
        Route::delete ('sc/{id}/delete-photo/{id_photo}', 'ServiceCenterCabinet\CabinetController@deletePhotoService')->name('cabinet.delete.photo.service');
        Route::put ('sc/{id}/disabled', 'ServiceCenterCabinet\CabinetController@disabledService')->name('cabinet.disabled.service');
        Route::put ('sc/{id}/enabled', 'ServiceCenterCabinet\CabinetController@enabledService')->name('cabinet.enabled.service');
        Route::get ('sc/list-disabled', 'ServiceCenterCabinet\CabinetController@listDisabledService')->name('cabinet.list-disabled.service');

        Route::get ('messages', 'ServiceCenterCabinet\UserRequestController@getMessages')->name('cabinet.messages');
        Route::put ('messages', 'ServiceCenterCabinet\UserRequestController@putMessages')->name('cabinet.messages');
        Route::get ('open/message', 'ServiceCenterCabinet\UserRequestController@openMessage')->name('cabinet.open.message');
        Route::get ('requests', 'ServiceCenterCabinet\UserRequestController@allRequest')->name('cabinet.requests');
        Route::get ('request/change_status', 'ServiceCenterCabinet\UserRequestController@changeStatus')->name('cabinet.request.change_status');

        Route::get('add/service', 'ServiceCenterCabinet\CabinetController@getAddService')->name('cabinet.add.service');
        Route::post('add/service', 'ServiceCenterCabinet\CabinetController@postAddService')->name('cabinet.add.service');
        Route::get('logout', 'ServiceCenterCabinet\CabinetController@getLogout')->name('cabinet.logout');

        Route::group(['middleware' => ['admin']], function (){
            Route::group(['prefix' => 'admin'], function () {

                Route::get('user-list', 'ServiceCenterCabinet\Admin\CabinetController@getUserList')->name('cabinet.admin.user.list');
                Route::get('user/{id}/list-sc', 'ServiceCenterCabinet\Admin\CabinetController@getUserListSc')->name('cabinet.admin.user.list.sc');
                Route::get('list-sc', 'ServiceCenterCabinet\Admin\CabinetController@getListSc')->name('cabinet.admin.list.sc');

                Route::get('sc/{id}', 'ServiceCenterCabinet\Admin\CabinetController@getService')->name('cabinet.admin.service')->where('id', '[0-9]+');
                Route::put ('sc/{id}/update', 'ServiceCenterCabinet\Admin\CabinetController@putUpdateService')->name('cabinet.admin.update.service')->where('id', '[0-9]+');
                Route::post ('sc/{id}/add-personal', 'ServiceCenterCabinet\Admin\CabinetController@postAddPersonalService')->name('cabinet.admin.add.personal.service')->where('id', '[0-9]+');
                Route::delete ('sc/{id}/delete-personal/{id_person}', 'ServiceCenterCabinet\Admin\CabinetController@deletePersonalService')->name('cabinet.admin.delete.personal.service');
                Route::post ('sc/{id}/add-photo', 'ServiceCenterCabinet\Admin\CabinetController@postAddPhotoService')->name('cabinet.admin.add.photo.service')->where('id', '[0-9]+');
                Route::delete ('sc/{id}/delete-photo/{id_photo}', 'ServiceCenterCabinet\Admin\CabinetController@deletePhotoService')->name('cabinet.admin.delete.photo.service');

                Route::get ('messages', 'ServiceCenterCabinet\Admin\RequestController@getMessages')->name('cabinet.admin.messages');
                Route::get ('requests', 'ServiceCenterCabinet\Admin\RequestController@allRequest')->name('cabinet.admin.requests');

                Route::get ('comments', 'ServiceCenterCabinet\Admin\CommentController@allComments')->name('cabinet.admin.comments');
                Route::get ('comment/{id}', 'ServiceCenterCabinet\Admin\CommentController@getComment')->name('cabinet.admin.comment');
            });
        });
    });
});
