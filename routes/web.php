<?php

use Illuminate\Support\Facades\Route;
use App\Mail\Contact;
use App\Models\SessionWatch;
use Illuminate\Http\Request;

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
Route::get('/Dash', function () {
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
Route::get('/Dash/Messages', function () {
    return view('Dash/messages');
});
Route::get('/Push', function () {
    return view('pusher');
});
Route::get('/Dash/MovieEdit/{id}', function ($id) {
    return view('Dash/MovieEdit', ["idMovie" => $id]);
});
Route::get('/TOP3/{type}', "App\Http\Controllers\MoviesController@Top3");
Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

Route::get('/Search', function () {
    return view('search');
});
Route::get('/Session/{Session}', function ($Session) {
    $id = substr($Session, strpos($Session, '.') + 1);
    return view('watchSession', ["Session" => $Session, "id" => $id]);
});
Route::get('/Favs', function () {
    return view('favs');
});
Route::get('/Category/{category}', function ($cat) {
    return view('category', ["category" => $cat]);
});
Route::get('/Logout', "App\Http\Controllers\UsersController@Logout");
Route::get('/CheckSession', function (Request $req) {
    $session = SessionWatch::where("SessionID", $req->input("id"))->first();
    if ($session) {
        return response("exist", 200);
    } else {
        return response("Session ID is invalid", 500);
    }
});

//User Ctrl
//Route::post('/AddAccount', [TaskController::class,'AddAccount']);
Route::post('/CreatingAccount', "App\Http\Controllers\UsersController@SignUp");
Route::post('/Logging', "App\Http\Controllers\UsersController@Login");
Route::post('/ChangeAvatar', "App\Http\Controllers\UsersController@ChangeAvatar");
Route::post('/EditProfile', "App\Http\Controllers\UsersController@EditProfile");
Route::post('/ContactSend', "App\Http\Controllers\UsersController@ContactSend");
Route::delete('/DeleteUser/{id}', "App\Http\Controllers\UsersController@DeleteUser");

Route::post('SendCode', "App\Http\Controllers\UsersController@SendCode");
Route::post('ChangePass', "App\Http\Controllers\UsersController@ChangePass");


//Movie Ctrl
Route::post('/AddMovie', "App\Http\Controllers\MoviesController@AddMovie");
Route::post('/AddCategory', "App\Http\Controllers\MoviesController@AddCategory");
Route::post('/AddFavorite', "App\Http\Controllers\MoviesController@AddFavorite");
Route::get('/GetSuggestion', "App\Http\Controllers\MoviesController@Suggestion");
Route::get('/GetToken', function () {
    return csrf_token();
});
Route::post('/EditMovie', "App\Http\Controllers\MoviesController@EditMovie");
Route::delete('/DeleteMovie/{id}', "App\Http\Controllers\MoviesController@DeleteMovie");
