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


Route::group(['middleware' => ['web', 'session.page']], function (){
    Route::get('/', 'SiteController@getIndex')->name('main');
    Route::get('about', 'SiteController@getAbout')->name('about');
    Route::get('support', 'SiteController@getSupport')->name('support');
    Route::post('support', 'SiteController@postSupport')->name('support');
    Route::get('diagnostics', 'DiagnosticsController@getIndex')->name('diagnostics');
    Route::post('diagnostic', 'DiagnosticsController@postDiagnostic')->name('diagnostic');

    Route::get('catalog', 'CatalogController@getIndex')->name('catalog');
    Route::get('sc/{id}', 'CatalogController@getServiceCenter')->name('sc');
    Route::post('sc/{id}/add-comments', 'CatalogController@postAddCommentsServiceCenter')->name('sc.add.comments');


    Route::post('forms/main', 'FormsController@mainHelpRequest')->name('form.main.help');
    Route::post('forms/sc', 'FormsController@ScRequest')->name('form.sc');
    Route::get('html', 'FormsController@html')->name('form.sc');

    Route::get('user/login', 'LoginController@getUserLogin')->name('user.login');
    Route::post('user/login', 'LoginController@postUserLogin')->name('user.login');
    Route::get('user/registration', 'RegisterController@getUserIndex')->name('user.registration');
    Route::post('user/registration', 'RegisterController@postUserRegister')->name('user.registration');

    Route::get('service-center/login', 'LoginController@getServiceLogin')->name('service.login');
    Route::post('service-center/login', 'LoginController@postServiceLogin')->name('service.login');
    Route::get('service-center/registration', 'RegisterController@getServiceRegister')->name('service.registration');
    Route::post('service-center/registration', 'RegisterController@postServiceRegister')->name('service.registration');


    Route::get('/auth', 'SocialAuthController@auth')->name('auth');
    Route::get('/auth/facebook', 'SocialAuthController@facebookRedirect')->name('auth.facebook');
    Route::get('/auth/facebook/callback', 'SocialAuthController@facebookCallback')->name('auth.facebook.callback');

    Route::get('/auth/google', 'SocialAuthController@googleRedirect')->name('auth.google');
    Route::get('/auth/google/callback', 'SocialAuthController@googleCallback')->name('auth.google.callback');

    Route::get('/auth/linkedin', 'SocialAuthController@linkedinRedirect')->name('auth.linkedin');
    Route::get('/auth/linkedin/callback', 'SocialAuthController@linkedinCallback')->name('auth.linkedin.callback');

    Route::get('load', 'ImportController@load')->name('load');
    Route::get('excel', 'ImportController@excel')->name('excel');

});

Route::group(['middleware' => ['user.profile']], function (){
    Route::get('user/dashboard', 'UserProfile\ProfileController@getDashboard')->name('user.dashboard');

    Route::get('user/favorite', 'UserProfile\FavoriteController@getIndex')->name('user.favorite');

    Route::get('user/profile', 'UserProfile\ProfileController@getProfile')->name('user.profile');
    Route::post('user/profile', 'UserProfile\ProfileController@postProfile')->name('user.profile');

    Route::get('user/setting', 'UserProfile\ProfileController@getSetting')->name('user.setting');
    Route::post('user/setting', 'UserProfile\ProfileController@postSetting')->name('user.setting');
    Route::get('user/social/link/google', 'UserProfile\ProfileController@linkSocialGoogleAccount')->name('user.social.link.google');
    Route::get('user/social/link/facebook', 'UserProfile\ProfileController@linkSocialFacebookAccount')->name('user.social.link.facebook');
    Route::get('user/social/link/linkedin', 'UserProfile\ProfileController@linkSocialLinkedinAccount')->name('user.social.link.linkedin');
    Route::post('user/social/unlink', 'UserProfile\ProfileController@unlinkSocialAccount')->name('user.social.unlink');

    Route::get('user/requests', 'UserProfile\UserRequestController@getIndex')->name('user.requests');
    Route::get('user/request/search', 'UserProfile\UserRequestController@findRequestByRid')->name('user.request.find');
    Route::post('user/request/bind', 'UserProfile\UserRequestController@bindRequestToUser')->name('user.request.bind');
    Route::post('user/request/change_status', 'UserProfile\UserRequestController@changeStatusByRequest')->name('user.request.change_status');
    Route::get('user/request/{r_id}', 'UserProfile\UserRequestController@getRequestByRid')->name('user.request')->where('r_id', '[0-9]+');
    Route::post('user/request/{r_id}/send_message', 'UserProfile\UserRequestController@sendMessageByRequest')->name('user.request.send_message');

    Route::get('user/logout', 'UserProfile\ProfileController@getLogout')->name('user.logout');
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

// Route Seo cabinet
require_once ('seo_route.php');
