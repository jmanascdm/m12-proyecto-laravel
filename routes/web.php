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

Route::get('/admin/accounts', 'Admin\AccountsController@index')->name('admin.accounts');
Route::get('/admin/payments', 'Admin\PaymentsController@index')->name('admin.payments');
Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin.categories');
Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');

Route::get('/accounts', 'Admin\AccountsController@getAccounts')->name('accounts.get');
Route::post('/account/edit', 'Admin\AccountsController@setAccount')->name('account.edit');
Route::post('/account/delete', 'Admin\AccountsController@deleteAccount')->name('account.delete');

Route::post('/payment/edit', 'Admin\PaymentsController@setPayment')->name('payment.edit');
Route::post('/payment/delete', 'Admin\PaymentsController@deletePayment')->name('payment.delete');

Route::get('/categories', 'Admin\CategoriesController@getCategories')->name('categories.get');
Route::post('/category/edit', 'Admin\CategoriesController@update')->name('category.update');
Route::post('/category/enable', 'Admin\CategoriesController@enable')->name('category.enable');
Route::post('/category/disable', 'Admin\CategoriesController@disable')->name('category.disable');
Route::post('/category/delete', 'Admin\CategoriesController@delete')->name('category.delete');

Route::post('/user/edit', 'Admin\UsersController@setUser')->name('user.edit');
Route::post('/user/delete', 'Admin\UsersController@deleteUser')->name('user.delete');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.auth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');