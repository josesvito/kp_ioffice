<?php
use App\Http\Controllers\PerjanjianController;

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

Route::get('/', 'Controller@viewHome');
Route::get('/admin', function () {
    return redirect('');
});

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'Controller@login');
Route::get('/logout', function () {
    return redirect('login');
});

Route::resource('/dokumen', 'DokumenController');
Route::resource('/perjanjian', 'PerjanjianController');
Route::resource('/warning', 'ExpiredPerjanjianController');
Route::resource('/mitra', 'MitraController');
Route::resource('/peserta', 'PesertaController');
