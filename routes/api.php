<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cities', 'Api\SiteController@getCities')->name('api.cities');
Route::get('streets', 'Api\SiteController@getStreets')->name('api.streets');
Route::get('metro', 'Api\SiteController@getMetro')->name('api.metro');
Route::get('districts', 'Api\SiteController@getDistricts')->name('api.districts');
Route::get('manufacturers', 'Api\SiteController@getManufacturers')->name('api.manufacturers');

Route::get('catalog', 'Api\CatalogController@getIndex')->name('api.catalog');
Route::get('sc/{id}', 'Api\CatalogController@getServiceCenter')->name('api.sc');
Route::get('sc/{id}/comments', 'Api\CommentController@commentsByServiceCenter')->name('api.comments');
