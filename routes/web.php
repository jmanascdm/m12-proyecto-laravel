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

Route::get('/admin/accounts', 'DataTables\AccountsController@getAccounts')->name('admin.accounts');
Route::post('/account/edit', 'AccountsController@setAccount')->name('account.edit');
Route::post('/account/delete', 'AccountsController@deleteAccount')->name('account.delete');

Route::get('/admin/payments', 'DataTables\PaymentsController@getPayments')->name('admin.payments');
Route::post('/payment/delete', 'DataTables\PaymentsController@deletePayment')->name('payment.delete');

Route::get('/test', 'TestController@index')->name('test');