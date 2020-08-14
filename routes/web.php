<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/*
Route::get('/', function () {
    return view('welcome');
}); //*/

/*
Route::get('/', function () {
    return view('index');
});//*/
/*

Route::get('/about', function () {
    return view('pages.about');
});//*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Auth::routes();
Route::resource('posts', 'PostsController');
Route::delete('triathlon-details/destroy2/{id1}/{id2}', 'TriathlonDetailsController@destroy2');
Route::get('triathlon-details/showevent/{id1}/{id2}', 'TriathlonDetailsController@showevent');
Route::get('triathlon-details/editevent/{id1}/{id2}', 'TriathlonDetailsController@editevent');
Route::resource('triathlon-details', 'TriathlonDetailsController');




Route::get('/home', 'HomeController@index')->name('home');
