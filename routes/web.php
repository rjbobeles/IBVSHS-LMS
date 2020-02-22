<?php
/*
|--------------------------------------------------------------------------
| Authentication Route
|--------------------------------------------------------------------------
|
| Enables email verification bundled with Authentication system. 
|
*/

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

Route::middleware('auth', 'verified', 'isActive')->group(function() {
    
    //Librarian Route
    Route::prefix('librarian')->group(function () {

        Route::resource('patrons', 'PatronController');
        //Librarian Patrons View
        Route::get('/', 'PatronController@index')->name('librarian.patrons.index');
        Route::get('/{id}', 'PatronController@show')->name('librarian.patrons.show');
        
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

Route::middleware('auth', 'verified', 'isAdmin', 'isActive')->group(function() {

    //Admin Route
    Route::prefix('admin')->group(function () {

        //User Controller
        Route::resource('users', 'UserController');

        //System Logs
        Route::prefix('logs')->group(function () {
    
            //User Logs
            Route::prefix('user')->group(function () {
                Route::get('/', 'LogUserController@index')->name('logs.user.index');
                Route::get('/{id}', 'LogUserController@show')->name('logs.user.show');
            });

            //Book Logs
            Route::prefix('book')->group(function () {
                Route::get('/', 'LogBookController@index')->name('logs.book.index');
                Route::get('/{id}', 'LogBookController@show')->name('logs.book.show');
            });

            //Patron Logs
            Route::prefix('patron')->group(function () {
                Route::get('/', 'LogPatronController@index')->name('logs.patron.index');
                Route::get('/{id}', 'LogPatronController@show')->name('logs.patron.show');
            });

            //Transaction Logs
            Route::prefix('transaction')->group(function () {
                Route::get('/', 'LogTransactionController@index')->name('logs.transaction.index');
                Route::get('/{id}', 'LogTransactionController@show')->name('logs.transaction.show');
            });
        });
    });
});
