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

Auth::routes(['verify' => true]);
Route::resource('/employer', 'EmployerController')->except('index', 'show');
Route::resource('/offers', 'OfferController')->except('index', 'show');
Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/properties', 'AdminController@properties')->name('admin.properties');
Route::get('/admin/users', 'AdminController@users')->name('admin.users');
Route::delete('/admin/e/{employer}', 'AdminController@destroyEmployer')->name('admin.destroy.employer');
Route::delete('/admin/o/{offer}', 'AdminController@destroyOffer')->name('admin.destroy.offer');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome')->name('welcome');
