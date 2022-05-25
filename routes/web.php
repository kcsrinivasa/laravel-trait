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

Route::get('/', function () {  return view('welcome'); });
Route::get('/user','App\Http\Controllers\UserController@index')->name('user.index');
Route::post('/user','App\Http\Controllers\UserController@store')->name('user.store');

Route::get('/post','App\Http\Controllers\PostController@index')->name('post.index');
Route::post('/post','App\Http\Controllers\PostController@store')->name('post.store');
