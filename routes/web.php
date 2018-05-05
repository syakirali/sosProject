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

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/register', function(){
    return redirect()->route('register');
});

Route::post('/logout','UserController@performLogout');

Route::get('/p', function(){
  return view('lab');
});

Route::get('/beranda', 'HomeController@index')->name('beranda');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getLocationData/{id}/{type}', 'GetLocationData@index');

Route::middleware(['auth'])->group(function () {
  Route::get('/home/petugas/tambah', 'Auth\RegisterController@showRegistrationForm')->name('petugas tambah')->middleware('admin');

  Route::get('/home/petugas/tampil', 'Auth\RegisterController@tampil')->name('petugas tampil')->middleware('admin');

  Route::get('/home/petugas/{id}/hapus', 'Auth\RegisterController@hapus')->name('petugas hapus')->middleware('admin');

  Route::put('/home/petugas/uploadPP', 'Auth\RegisterController@uploadPP')->name('petugas PP');

  Route::get('/home/agenda/tambah', 'AgendaController@tampilForm')->name('agenda form')->middleware('admin');

  Route::get('/home/agenda/tampil', 'AgendaController@tampil')->name('agenda tampil');

  Route::get('/home/agenda/{id}/hapus', 'AgendaController@hapus')->middleware('admin');

  Route::post('/home/tambah/agenda', 'AgendaController@tambah')->name('agenda tambah')->middleware('admin');

  Route::get('/home/laporan/tampil', 'LaporanController@tampil')->name('laporan tampil')->middleware('admin');

  Route::get('/home/laporan/{id}/hapus', 'LaporanController@hapus')->middleware('admin');

  Route::get('/home/laporan/{id}/detail', 'LaporanController@detail')->middleware('admin');

  Route::get('/home/laporan/tambah', 'LaporanController@tampilForm')->name('laporan form');

  Route::post('/home/laporan/tambah', 'LaporanController@tambah')->name('laporan tambah');

  Route::get('/home/laporan/tambah/{id_agenda}', 'LaporanController@tampilForm_');
});

Auth::routes();
