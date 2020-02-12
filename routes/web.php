<?php
/*
|--------------------------------------------------------------------------
| Authentication Route
|--------------------------------------------------------------------------
|
| Removes reegister route when an account with an admin role already exists.
|
*/

use App\User;
if (User::where("role","=", "admin")->exists())
    Auth::routes(['register' => false, 'verify' => true]);
else
    Auth::routes(['verify' => true]);

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

//Patron Routes
Route::middleware('guest')->group(function() {

});

//Users Route
Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Librarian Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Librarians
|
*/

Route::middleware('auth', 'verified', 'isLibarian')->group(function() {
    
    //Librarian Route
    Route::prefix('librarian')->group(function () {
        
    });
});

/*
|--------------------------------------------------------------------------
| Admin Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Admins
|
*/

Route::middleware('auth', 'verified', 'isAdmin')->group(function() {

    //Admin Route
    Route::prefix('admin')->group(function () {

        //System Logs
        Route::prefix('logs')->group(function () {
    
            //User Logs
            Route::prefix('user')->group(function () {
                Route::get('/', 'LogUserController@index');
                Route::get('/{id}', 'LogUserController@show');
            });

            //Book Logs
            Route::prefix('book')->group(function () {
                Route::get('/', 'LogBookController@index');
                Route::get('/{id}', 'LogBookController@show');
            });

            //Patron Logs
            Route::prefix('patron')->group(function () {
                Route::get('/', 'LogPatronController@index');
                Route::get('/{id}', 'LogPatronController@show');
            });
        });
    });
});