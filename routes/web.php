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
Route::get('/admin/e', 'AdminController@employers')->name('admin.employers.index');
Route::get('/admin/e/{employer}', 'AdminController@employers')->name('admin.employers.show');
Route::get('/admin/e/{employer}/offers', 'AdminController@offers')->name('admin.employers.offers');
Route::delete('/admin/e/{employer}', 'AdminController@destroyEmployer')->name('admin.destroy.employer');
Route::delete('/admin/o/{offer}', 'AdminController@destroyOffer')->name('admin.destroy.offer');
Route::delete('/admin/t/{technology}', 'AdminController@destroyTechnology')->name('admin.destroy.tech');
Route::delete('/admin/exp/{experience}', 'AdminController@destroyExperience')->name('admin.destroy.exp');
Route::delete('/admin/emp/{employment}', 'AdminController@destroyEmployment')->name('admin.destroy.emp');
Route::delete('/admin/c/{currency}', 'AdminController@destroyCurrency')->name('admin.destroy.cur');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome')->name('welcome');
