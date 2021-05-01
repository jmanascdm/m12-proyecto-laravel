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
Route::post('/account/edit', 'Admin\AccountsController@setAccount')->name('account.edit');
Route::post('/account/delete', 'Admin\AccountsController@deleteAccount')->name('account.delete');

Route::get('/admin/payments', 'Admin\PaymentsController@index')->name('admin.payments');
Route::post('/payment/edit', 'Admin\PaymentsController@setPayment')->name('payment.edit');
Route::post('/payment/delete', 'Admin\PaymentsController@deletePayment')->name('payment.delete');

Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin.categories');
Route::post('/category/edit', 'Admin\CategoriesController@setCategory')->name('category.edit');
Route::post('/category/delete', 'Admin\CategoriesController@deleteCategory')->name('category.delete');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');
Route::post('/user/edit', 'Admin\UsersController@setUser')->name('user.edit');
Route::post('/user/delete', 'Admin\UsersController@deleteUser')->name('user.delete');

Route::get('/test', 'TestController@index')->name('test');
