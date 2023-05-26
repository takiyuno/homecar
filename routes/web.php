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

Route::get('/', function () {
    return redirect('/home');   // redirect เป็นการบังคับวิ่งเข้าหน้า web
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    //----------------Admin register-----------------//
    route::resource('MasterMaindata','UserController');

    route::resource('MasterDatacar','DatacarController');
    Route::post('/ExportPDFIndex', 'DatacarController@ReportPDFIndex');
    Route::get('/datacar/viewsee/{id}/{car_type}', 'DatacarController@viewsee')->name('datacar.viewsee');
    Route::get('/datacar/view/{type}', 'DatacarController@index')->name('datacar');
    Route::get('/datacar/create/{type}', 'DatacarController@create')->name('datacar.create');
    Route::post('/datacar/store', 'DatacarController@store')->name('datacar.store');
    Route::get('/datacar/edit/{id}/{car_type}', 'DatacarController@edit')->name('datacar.edit');
    Route::get('/datacar/trackingCars/{id}/{type}/{type2}', 'DatacarController@trackingCars')->name('datacar.trackingCars');
    Route::patch('/datacar/updateinfo/{id}', 'DatacarController@updateinfo')->name('datacar.updateinfo');
    Route::delete('/datacar/delete/{id}', 'DatacarController@destroy')->name('datacar.destroy');
    Route::get('/datacar/Savestore/{Str1}/{Str2}/{type}', 'DatacarController@Savestore')->name('datacar.Savestore');
    Route::post('/datacar/SearchData/{type}', 'DatacarController@SearchData')->name('datacar.SearchData');
    Route::get('/datacar/deletePic/{id}', 'DatacarController@deletePic')->name('datacar.deletePic');
    Route::get('/datacar/upload/', 'DatacarController@uploadImg')->name('datacar.uploadImg');

    route::resource('reportBetween','ReportController');
    Route::get('/reportcar/viewreport/{type}', 'ReportController@index')->name('reportcar');
    Route::get('/ExportStockcar', 'ReportController@ReportExpire');
    Route::post('/Report/homecar', 'ReportController@ReportStockcar')->name('report.holdcar');
    Route::get('/Report/Home/{type}', 'ReportController@index')->name('report');
    Route::get('/reportcar/export', 'ReportController@export');

    route::resource('MasterResearchCus','ResearchCusController');
    Route::get('/ResearchCus/view/{type}', 'ResearchCusController@index')->name('ResearchCus');
    Route::get('/ResearchCus/viewSuccess/{type}', 'ResearchCusController@saleShow')->name('ResearchCus2');
    Route::get('/ResearchCus/viewTracking/{type}', 'ResearchCusController@saleShow')->name('ResearchCus3');
    Route::post('/ResearchCus/SearchData/{type}', 'ResearchCusController@SearchData')->name('ResearchCus.SearchData');
    Route::post('/ResearchCus/ReportCus/{type}', 'ResearchCusController@ReportCus')->name('ResearchCus.ReportCus');


    Route::get('/BoardMaster/view/{type}', 'BoardController@index')->name('BoardMaster');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');

    route::resource('MasterDataCarIn','DataCarsInController');
    Route::get('/datacarin/view/{type}', 'DataCarsInController@index')->name('datacarin');
    Route::get('/datacarin/create/{type}', 'DataCarsInController@create')->name('datacarin.create');
    Route::get('/datacarin/viewsee/{id}/{car_type}', 'DataCarsInController@viewsee')->name('dataCars.viewsee');
    Route::post('/datacarin/store', 'DataCarsInController@store')->name('datacarin.store');
    Route::get('/datacarin/edit/{id}/{car_type}', 'DataCarsInController@edit')->name('datacarin.edit');
    Route::post('/Report', 'DataCarsInController@ReportExcel');
    Route::get('/datacarin/createTo/{type}', 'DataCarsInController@createTo')->name('datacarin.createTo');
    Route::delete('/datacarin/delete/{id}', 'DataCarsInController@destroy')->name('datacarin.destroy');
    Route::get('/datacarin/deletePic/{id}', 'DataCarsInController@deletePic')->name('datacarin.deletePic');
    Route::get('/datacarin/upload/', 'DataCarsInController@uploadImg')->name('datacarin.uploadImg');
});