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

use App\Http\Controllers\Controller as Controller;

Route::get('/', 'Controller@viewHome');
Route::get('/logout', function() {
    return redirect('login');
});
Route::get('/login', function() {
    return view('login');
});
Route::post('/login', function() {
    if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
        $data = array_map('strval', $_POST);
        return new Controller($data);
    } else {
        return back()->withInput();
    }
});

Route::get('/admin', function() {
    return redirect('');
});

Route::resource('/dokumen', 'DokumenController');
Route::resource('/perjanjian', 'PerjanjianController');
Route::resource('/mitra', 'MitraController');
Route::resource('/peserta', 'PesertaController');
