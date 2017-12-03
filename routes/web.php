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
//Accounts
Route::get('/app', function () {
    return view('entrance.app');
});



Route::get('/testform',function(){
  return view('testform');
});

Route::get('/accounts','AccountController@index');
Route::post('/accounts','AccountController@store');
Route::patch('/accounts/{id}','AccountController@update');
Route::delete('/accounts/{id}','AccountController@destroy');

Route::get('/grades','GradeController@index');
Route::post('/grades','GradeController@store');
Route::patch('/grades/{id}','GradeController@update');
Route::delete('/grades/{id}','GradeController@destroy');


Route::get('/classes','FormController@index');
Route::post('/classes','FormController@store');
Route::patch('/classes/{id}','FormController@update');
Route::delete('/classes/{id}','FormController@destroy');


Route::get('/subjects','SubjectController@index');
Route::post('/subjects','SubjectController@store');
Route::patch('/subjects/{id}','SubjectController@update');
Route::delete('/subjects/{id}','SubjectController@destroy');

Route::get('/classsubjects','FormSubjectController@index');
Route::post('/classsubjects','FormSubjectController@store');
Route::patch('/classsubjects/{id}','FormSubjectController@update');
Route::delete('/classsubjects/{id}','FormSubjectController@destroy');

Route::get('/educators','EducatorController@index');
Route::post('/educators','EducatorController@store');
Route::patch('/educators/{id}','EducatorController@update');
Route::delete('/educators/{id}','EducatorController@destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posttest', function (){
    return view('posttest');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
