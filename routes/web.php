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
Route::get('/logout', ['uses' =>'loginController@logout','as'=>'logout']);
Route::group(['middleware' => ['seller_guest']], function() {
    Route::get('/', ['uses' =>'loginController@login','as'=>'login.login']);
    Route::get('/login', ['uses' =>'loginController@login','as'=>'login.login']);
    Route::post('/login-check', ['uses' =>'loginController@loginCheck','as'=>'login.check']);
});

Route::group(['middleware' => 'seller_auth'], function() {
    Route::group(['namespace' => 'Admin','prefix' => 'admin'], function () {
        Route::get('/', ['uses' =>'homeController@index','as'=>'home.index']);
        Route::get('/dashboard', ['uses' =>'homeController@index','as'=>'home.index']);
        //Karyawan Super Admin
        Route::get('/user', ['uses' =>'userController@index','as'=>'user.index']);
        Route::post('/user', ['uses' =>'userController@create','as'=>'user.create']);
        Route::get('/user/edit', ['uses' =>'userController@edit','as'=>'user.edit']);
        Route::get('/user/delete/{id}', ['uses' =>'userController@delete','as'=>'user.delete']);
        //position
        Route::get('/position', ['uses' =>'positionController@index','as'=>'position.index']);
        Route::get('/position', ['uses' =>'positionController@index','as'=>'position.index']);
        Route::post('/position', ['uses' =>'positionController@create','as'=>'position.create']);
        Route::get('/position/edit', ['uses' =>'positionController@edit','as'=>'position.edit']);
        Route::get('/position/delete/{id}', ['uses' =>'positionController@delete','as'=>'position.delete']);

        //investor
        Route::get('/investor', ['uses' =>'investorController@index','as'=>'investor.index']);
        Route::get('/investor-index', ['uses' =>'investorController@indexAjax','as'=>'investor.indexAjax']);
        Route::post('/investor', ['uses' =>'investorController@create','as'=>'investor.create']);
        Route::get('/position/edit', ['uses' =>'positionController@edit','as'=>'position.edit']);
        Route::get('/position/delete/{id}', ['uses' =>'positionController@delete','as'=>'position.delete']);

        Route::get('/investor-compare-index', ['uses' =>'investorController@compareIndex','as'=>'investor.compare.index']);
        Route::get('/investor-compore-index-ajax', ['uses' =>'investorController@compareindexAjax','as'=>'investor.compare.indexAjax']);
        Route::get('/investor-generate-excel', ['uses' =>'investorController@generateExcel','as'=>'investor.generate.excel']);
        Route::get('/investor-graph', ['uses' =>'investorController@countByDateForGraph','as'=>'investor.count.graph']);
    });
});