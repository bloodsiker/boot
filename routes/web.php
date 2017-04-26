<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web']], function (){
    Route::get('/', 'SiteController@getIndex')->name('main');
    Route::get('load', 'SiteController@load')->name('load');
    Route::get('about', 'SiteController@getAbout')->name('about');
    Route::get('support', 'SiteController@getSupport')->name('support');
    Route::get('diagnostics', 'DiagnosticsController@getIndex')->name('diagnostics');

    Route::get('catalog', 'CatalogController@getIndex')->name('catalog');
    Route::get('sc/{id}', 'CatalogController@getServiceCenter')->name('sc');


    Route::post('forms/main', 'FormsController@mainHelpRequest')->name('form.main.help');

    Route::get('user/registration', 'RegisterController@getUserIndex')->name('user.registration');
    Route::post('user/registration', 'RegisterController@postUserIndex')->name('user.create');

    Route::get('service-center/login', 'LoginController@getServiceLogin')->name('service.login');
    Route::post('service-center/login', 'LoginController@postServiceLogin')->name('service.login');
    Route::get('service-center/registration', 'RegisterController@getServiceRegister')->name('service.registration');
    Route::post('service-center/registration', 'RegisterController@postServiceRegister')->name('service.registration');

});

// Route Cabinet Service Center
require_once ('service_route.php');

Route::get('adm', 'Auth\AuthController@getAdmin')->name('auth.admin');
Route::get('adm/auth', 'Auth\AuthController@getAuth')->name('auth.auth');
Route::post('adm/auth', 'Auth\AuthController@postAuth')->name('auth.auth');

// Route Crm cabinet
require_once ('crm_route.php');

// Route Admin cabinet
require_once ('admin_route.php');


