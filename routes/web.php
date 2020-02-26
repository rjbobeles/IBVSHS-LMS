<?php
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

/*
|--------------------------------------------------------------------------
| Patron Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Patrons
|
*/

Route::middleware('guest')->group(function() {

});

/*
|--------------------------------------------------------------------------
| User Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Users
|
*/


Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('user')->group(function () { Auth::routes(['verify' => true]); });

Route::middleware('auth')->group(function() { 
    
    //User Route
    Route::prefix('user')->group(function () {
           
        //Change Password
        Route::get('/changepassword', 'Auth\ChangePasswordController@edit')->name('changepassword.edit');
        Route::put('/changepassword', 'Auth\ChangePasswordController@update')->name('changepassword.update');
    });
});

/*
|--------------------------------------------------------------------------
| Librarian Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Librarians
|
*/

Route::middleware('auth', 'verified', 'isLibrarian', 'isActive')->group(function() {
    
    //Librarian Route
    Route::prefix('librarian')->group(function () {

        //Patrons
        Route::resource('patrons', 'PatronController');

        //Book Controller
        Route::resource('books', 'BookController');

        Route::get('/', 'BookController@Index')->name('librarian.books.index');

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

        //Patron Controller
        Route::get('/patrons/', 'PatronController@index')->name('admin.patrons.index');
        Route::post('/patrons/', 'PatronController@store')->name('admin.patrons.store');
        Route::get('/patrons/create', 'PatronController@create')->name('admin.patrons.create');
        Route::delete('/patrons/{id}', 'PatronController@destroy')->name('admin.patrons.destroy');
        Route::put('/patrons/{id}', 'PatronController@update')->name('admin.patrons.update');
        Route::get('/patrons/{id}', 'PatronController@show')->name('admin.patrons.show');
        Route::get('/patrons/{id}/edit', 'PatronController@edit')->name('admin.patrons.edit');

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
