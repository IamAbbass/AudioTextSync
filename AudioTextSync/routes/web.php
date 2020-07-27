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

//Route::get('/', function () {return view('welcome');});

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/', 'AudioController@index');
Route::get('/create', 'AudioController@create');
Route::post('/', 'AudioController@store');
Route::get('/{audio_id}', 'AudioController@show');
Route::get('/{audio_id}/json', 'AudioController@show_json');
Route::get('/{audio_id}/download', 'AudioController@download');
