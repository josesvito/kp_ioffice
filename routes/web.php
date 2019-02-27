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

Route::get('/', 'Controller@viewHome');
Route::get('/admin', function(){
    return redirect('');
});
Route::get('/perjanjian', 'Controller@viewTerm');
Route::get('/dokumen', 'Controller@viewDoc');
Route::get('/mitra', 'Controller@viewPartner');
Route::get('/peserta', 'Controller@viewParticipant');
