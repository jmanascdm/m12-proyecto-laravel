<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/payment', 'HomeController@getPayment')->name('hm-payment');
Route::post('/payments', 'HomeController@getPayments')->name('hm-payments');

Route::get('/datatable', 'DatatableController@index')->name('datatable');
Route::post('/datatable/delete', 'DatatableController@delete')->name('dt-delete');

Route::get('/test', 'TestController@index')->name('test');