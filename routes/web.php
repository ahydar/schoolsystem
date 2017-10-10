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
Route::get('/accounts', function () {
    return view('entrance.accounts');
});

Route::get('/getaccounts','AccountController@getAccounts');

Route::get('/testform',function(){
  return view('testform');
});

Route::post('/accounts','AccountController@store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
