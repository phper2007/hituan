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
    return view('welcome');
});

Route::match(['get', 'post'], 'sf/standard', 'SfController@standard')->name('sf.standard');
Route::match(['post'], 'sf/finish', 'SfController@finish')->name('sf.finish');
Route::match(['get', 'post'], 'product/analysis', 'ProductController@analysis')->name('product.analysis');
Route::match(['post'], 'product/save', 'ProductController@save')->name('product.save');