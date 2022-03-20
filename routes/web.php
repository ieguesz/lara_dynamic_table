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

Route::get('/', function () {
    return view('permiso.index');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// accesos.permiso.select2menu
Route::group(['prefix' => 'access', 'as' =>'access.'], function (){
	Route::post('permiso/filtrar',"PermisoController@filterIndex")->name('permiso.filter');
	Route::resource('permiso',"PermisoController");
	Route::get('permiso/autocompletar/menu', 'PermisoController@autocompletarMenu')->name('permiso.select2menu');
	Route::get('permiso/autocompletar/user', 'PermisoController@autocompletarUser')->name('permiso.select2user');
	Route::get('permiso/autocompletar/filter/menu', 'PermisoController@autocompletarFilterMenu')->name('permiso.select2filter_menu');
	Route::get('permiso/autocompletar/filter/user', 'PermisoController@autocompletarFilterUser')->name('permiso.select2filter_user');
});