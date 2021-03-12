<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Mail\SendEmailTest;
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


Route::get('register','ValidationController@formValdiation')->name('form');
Route::post('post-register', 'ValidationController@validateForm')->name('valid');
Route::get('/login', 'ValidationController@loginPage')->name('login');
Route::post('post-login', 'ValidationController@loginForm')->name('auth');
Route::get('/home', 'ValidationController@homePage')->name('home')->middleware('admin');
Route::get('/logout','ValidationController@logOut')->name('logout');
Route::get('/email', function(){
    
    // Mail::to('aravindkumaranakr@gmail.com')->send(new SendEmailTest());
	return new SendEmailTest();
});