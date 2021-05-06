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
Route::post('/payment', 'HomeController@getPayment')->name('home.payment');
Route::post('/payments', 'HomeController@getPayments')->name('home.payments');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');
Route::get('/admin/payments', 'Admin\PaymentsController@index')->name('admin.payments');
Route::get('/admin/accounts', 'Admin\AccountsController@index')->name('admin.accounts');
Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin.categories');

Route::post('/user/edit', 'Admin\UsersController@update')->name('user.update');
Route::post('/user/create', 'Admin\UsersController@create')->name('user.create');
Route::post('/user/enable', 'Admin\UsersController@enable')->name('user.enable');
Route::post('/user/disable', 'Admin\UsersController@disable')->name('user.disable');
Route::post('/user/delete', 'Admin\UsersController@delete')->name('user.delete');

Route::post('/payment/update', 'Admin\PaymentsController@update')->name('payment.update');
Route::post('/payment/enable', 'Admin\PaymentsController@enable')->name('payment.enable');
Route::post('/payment/disable', 'Admin\PaymentsController@disable')->name('payment.disable');
Route::post('/payment/delete', 'Admin\PaymentsController@delete')->name('payment.delete');

Route::get('/accounts', 'Admin\AccountsController@getAccounts')->name('accounts.get');
Route::post('/account/edit', 'Admin\AccountsController@update')->name('account.update');
Route::post('/account/enable', 'Admin\AccountsController@enable')->name('account.enable');
Route::post('/account/disable', 'Admin\AccountsController@disable')->name('account.disable');
Route::post('/account/delete', 'Admin\AccountsController@delete')->name('account.delete');

Route::get('/categories', 'Admin\CategoriesController@getCategories')->name('categories.get');
Route::post('/category/edit', 'Admin\CategoriesController@update')->name('category.update');
Route::post('/category/enable', 'Admin\CategoriesController@enable')->name('category.enable');
Route::post('/category/disable', 'Admin\CategoriesController@disable')->name('category.disable');
Route::post('/category/delete', 'Admin\CategoriesController@delete')->name('category.delete');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.auth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');