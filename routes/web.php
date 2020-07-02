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

// Route::get('/', function () {return view('welcome');});
Route::get('user', 'UserController@index');


Auth::routes();
Route::get('/', 'MealplanController@index')->middleware('auth');
Route::get('kids', function () {return view('kids');})->middleware('auth');
Route::get('download', function () {return view('download');})->middleware('auth');
Route::get('setting', 'UserController@setting')->middleware('auth');

Route::post('setting', 'UserController@updateSetting');


