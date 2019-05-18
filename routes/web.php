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
Route::get('searchDokumenSkb', 'PerjanjianController@searchDokumenSkb')->name('perjanjian.searchDokumenSkb');
Route::get('searchMitra', 'PerjanjianController@searchMitra')->name('perjanjian.searchMitra');
Route::get('searchPihak1', 'PerjanjianController@searchPihak1')->name('perjanjian.searchPihak1');
Route::get('searchPihak2', 'PerjanjianController@searchPihak2')->name('perjanjian.searchPihak2');

//Warning
Route::resource('/warning', 'ExpiredPerjanjianController');

//DBLog
Route::resource('/log', 'LogController');

//Authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
