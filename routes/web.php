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

Route::get('/', 'PagesController@index');
Route::get('/charts', 'PagesController@charts');

//Mitra
Route::resource('mitra', 'MitraController');
Route::get('searchMitra', 'MitraController@search')->name('mitra.search');

//Peserta
Route::resource('peserta', 'PesertaController');
Route::get('searchPeserta', 'PesertaController@search')->name('peserta.search');

//Dokumen
Route::resource('dokumen', 'DokumenController');
Route::get('searchDokumen', 'DokumenController@search')->name('dokumen.search');

//Perjanjian
Route::resource('perjanjian', 'PerjanjianController');
Route::get('searchPerjanjian', 'PerjanjianController@search')->name('perjanjian.search');

//Warning
Route::resource('/warning', 'ExpiredPerjanjianController');

//Authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
