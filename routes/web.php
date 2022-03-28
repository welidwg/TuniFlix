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
    return view('index');
});
Route::get('/home', function () {
    return view('index');
});
Route::get('/Login', function () {
    return view('login');
});
Route::get('/SignUp', function () {
    return view('signup');
});
Route::get('/Discover/{type}', function ($type) {
    return view('discover', ["type" => $type]);
});
Route::get('/Profile', function () {
    return view('profile');
});
Route::get('/Contact', function () {
    return view('Contact');
});
Route::get('/Watch/{type}/{id}', function ($type, $id) {
    return view('watch', ["type" => $type, "id" => $id]);
});
Route::get('/Dash/Main', function () {
    return view('Dash/dash');
});

Route::get('/Dash/MoviesList', function () {
    return view('Dash/moviesList');
});
Route::get('/Dash/MovieAdd', function () {
    return view('Dash/movieAdd');
});
Route::get('/Dash/Users', function () {
    return view('Dash/usersList');
});
Route::get('/TOP3/{type}', "App\Http\Controllers\MoviesController@Top3");


Route::get('/Search', function () {
    return view('search');
});
Route::get('/Favs', function () {
    return view('favs');
});
Route::get('/Category/{category}', function ($cat) {
    return view('category', ["category" => $cat]);
});
Route::get('/Logout', "App\Http\Controllers\UsersController@Logout");

//User Ctrl
Route::post('/CreatingAccount', "App\Http\Controllers\UsersController@SignUp");
Route::post('/Logging', "App\Http\Controllers\UsersController@Login");
Route::post('/ChangeAvatar', "App\Http\Controllers\UsersController@ChangeAvatar");
Route::post('/EditProfile', "App\Http\Controllers\UsersController@EditProfile");
Route::post('/ContactSend', "App\Http\Controllers\UsersController@ContactSend");



//Movie Ctrl
Route::post('/AddMovie', "App\Http\Controllers\MoviesController@AddMovie");
Route::post('/AddCategory', "App\Http\Controllers\MoviesController@AddCategory");
Route::post('/AddFavorite', "App\Http\Controllers\MoviesController@AddFavorite");
Route::get('/GetSuggestion', "App\Http\Controllers\MoviesController@Suggestion");
