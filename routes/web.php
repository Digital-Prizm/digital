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
    return view('welcome');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


// Set for Login

//Route::get('/login', Login::class);
Route::view('login', 'login');
Route::view('dashboard', 'dashboard');
Route::view('/note', 'note');

//Route::post('/login', 'HomeController@login');
Route::get('/logout', 'login@logout');
//Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


// Set for Main modules

//Route::get('/note', 'NoteController@index')->name('index');
