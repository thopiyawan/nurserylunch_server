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
Route::get('/', 'MealplanController@showPlan')->middleware('auth');
Route::get('/mealplan/edit', 'MealplanController@editPlan')->middleware('auth');
Route::get('/kids', 'KidController@showClassroom')->middleware('auth');
Route::get('/download', function () {return view('download');})->middleware('auth');
Route::get('/setting', 'UserController@setting')->middleware('auth');


Route::post('/setting', 'UserController@updateSetting');

Route::get('/classroom/{id}', 'KidController@showClassroom')->middleware('auth');
Route::post('/classroom/create', 'KidController@createClassroom')->name('classroom.create');
Route::post('/classroom/edit/{id}', 'KidController@editClassroom')->name('classroom.edit');
Route::get('/classroom/toggle/{id}', 'KidController@toggleClassroom')->name('classroom.toggle');
Route::get('/classroom/delete/{id}', 'KidController@deleteClassroom')->name('classroom.delete');

Route::post('/kid/create', 'KidController@createKid')->name('kid.create');
Route::get('/kid/{id}', 'KidController@showKid')->name('kid.show');
Route::post('/kid/edit/{id}', 'KidController@editKid')->name('kid.edit');
Route::post('/kid/editmilk/{id}', 'KidController@editMilk')->name('kid.editmilk');
Route::get('/kid/deletemilk/{id}', 'KidController@deleteMilk')->name('kid.deletemilk');
Route::post('/kid/editnotes/{id}', 'KidController@editNotes')->name('kid.editnotes');
Route::post('/kid/moveclass/{id}', 'KidController@moveClass')->name('kid.moveclass');
Route::post('/kid/withdraw/{id}', 'KidController@withdraw')->name('kid.withdraw');

Route::post('/kid/createrestriction/{id}', 'KidController@createRestriction')->name('kid.createrestriction');
Route::post('/kid/editrestrictions/{id}', 'KidController@editRestrictions')->name('kid.editrestrictions');
Route::post('/kid/deleterestriction/{id}', 'KidController@deleteRestriction')->name('kid.deleterestriction');

Route::post('/kid/creategrowth/{id}', 'KidController@createGrowth')->name('kid.creategrowth');
Route::post('/kid/editgrowth/{id}', 'KidController@editGrowth')->name('kid.editgrowth');
Route::get('/kid/deletegrowth/{id}', 'KidController@deleteGrowth')->name('kid.deletegrowth');


Route::post('/mealplan/foodlogs', 'MealplanController@addFood');