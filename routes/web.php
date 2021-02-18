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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


#Route::get('/', 'Home');

Route::get('/registration', 'Register@registerForm');
Route::get('/salutation', 'Salutation@createForm');
Route::get('/gender', 'Gender@createForm');
Route::get('/occupation', 'Occupation@createForm');
Route::get('/industry', 'Industry@createForm');
Route::get('/sub-industry', 'SubIndustry@createForm');
Route::get('/family-relations', 'FamilyRelations@createForm');

// Set for Login


#Route::get('/login', 'Login@loginForm');
#Route::get('/dashboard', 'Dashboard@dashboard');
#Route::get('/note', 'Note@index');


#Route::get('/logout', 'Login@logout');

#Route::get('/test', 'Test@index');
