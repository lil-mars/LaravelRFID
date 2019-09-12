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

Route::get('/', 'EmpleadoController@index');
Route::resource('empleados', 'EmpleadoController');

Route::get('reports','ReportsController@jobs')->name('reports.jobs');
Route::post('reports','ReportsController@selectJobs')->name('reports.selectJobs');

Route::get('civilstates','ReportsController@civilStatus')->name('reports.civilStatus');

Route::get('child','ReportsController@child')->name('reports.child');
Route::post('child','ReportsController@selectChild')->name('reports.selectChild');

Route::get('age','ReportsController@age')->name('reports.age');

Route::get('gender','ReportsController@gender')->name('reports.gender');

Route::get('hours','ReportsController@hours')->name('reports.hours');
