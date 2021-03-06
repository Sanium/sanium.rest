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

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register/employer', 'Auth\RegisterController@register_employer')->name('register.employer');
Route::post('/register/client', 'Auth\RegisterController@register_client')->name('register.client');

Route::resource('/employer', 'EmployerController')->except('index', 'show', 'create', 'store');
Route::resource('/client', 'ClientController')->except('index', 'show', 'create', 'store');
Route::resource('/offers', 'OfferController')->except('index', 'show');

Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/properties', 'AdminController@properties')->name('admin.properties');

Route::get('/admin/users', 'AdminController@users')->name('admin.users.index');
Route::delete('/admin/u/{user}', 'AdminController@destroyUser')->name('admin.users.destroy');

Route::get('/admin/e/{employer}/offers', 'AdminController@offers')->name('admin.employers.offers');

Route::delete('/admin/o/{offer}', 'AdminController@destroyOffer')->name('admin.destroy.offer');
Route::delete('/admin/t/{technology}', 'AdminController@destroyTechnology')->name('admin.destroy.tech');
Route::delete('/admin/exp/{experience}', 'AdminController@destroyExperience')->name('admin.destroy.exp');
Route::delete('/admin/emp/{employment}', 'AdminController@destroyEmployment')->name('admin.destroy.emp');
Route::delete('/admin/c/{currency}', 'AdminController@destroyCurrency')->name('admin.destroy.cur');

Route::post('/offers/{offer}/contact', 'JobOfferResponseController@store')->name('offers.contact');
Route::delete('/jors/{jobOfferResponse}', 'JobOfferResponseController@destroy')->name('jors.destroy');
Route::post('/offers/{offer}/refresh', 'OfferController@refresh')->name('offers.refresh');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome')->name('welcome');
