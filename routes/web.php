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

Route::get('/admin/accounts', 'DataTables\AccountsController@index')->name('admin.accounts');
Route::post('/account/edit', 'AccountsController@setAccount')->name('account.edit');
Route::post('/account/delete', 'AccountsController@deleteAccount')->name('account.delete');

Route::get('/admin/payments', 'DataTables\PaymentsController@index')->name('admin.payments');
Route::post('/payment/edit', 'DataTables\PaymentsController@editPayment')->name('payment.edit');
Route::post('/payment/delete', 'DataTables\PaymentsController@deletePayment')->name('payment.delete');

Route::get('/admin/categories', 'DataTables\CategoriesController@index')->name('admin.categories');
Route::post('/category/edit', 'DataTables\CategoriesController@editCategory')->name('category.edit');
Route::post('/category/delete', 'DataTables\CategoriesController@deleteCategory')->name('category.delete');

Route::get('/admin/users', 'DataTables\UsersController@index')->name('admin.users');
Route::post('/user/edit', 'DataTables\UsersController@editCategory')->name('user.edit');
Route::post('/user/delete', 'DataTables\UsersController@deleteCategory')->name('user.delete');

Route::get('/test', 'TestController@index')->name('test');
