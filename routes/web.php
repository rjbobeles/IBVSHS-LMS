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

Route::get('/credits', 'CreditsController@Index')->name('credits');
Route::get('/credits', 'CreditsController@Secret')->name('secre');

/*
|--------------------------------------------------------------------------
| Patron Route
|--------------------------------------------------------------------------
|
| Routes that can only be accessible by Patrons
|
*/

Route::middleware('guest')->group(function() {
    Route::get('/', function() { return view('patron'); })->name('patron');
    Route::get('/books', 'BookController@PatronBooks')->name('patron.book.index');
    Route::get('/books/{id}', 'BookController@PatronBook')->name('patron.book.single');

    //Patrons
    Route::get('/records', 'PatronController@Records')->name('patron.book.records');
    Route::post('/records', 'PatronController@ViewRecords')->name('patron.book.records');

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
    /*
    |--------------------------------------------------------------------------
    | User Route
    |--------------------------------------------------------------------------
    |
    | Routes that can only be accessible by users
    |
    */

    Route::prefix('user')->group(function () {
           
        //Change Password
        Route::get('/changepassword', 'Auth\ChangePasswordController@edit')->name('changepassword.edit');
        Route::put('/changepassword', 'Auth\ChangePasswordController@update')->name('changepassword.update');
    });


    /*
    |--------------------------------------------------------------------------
    | Manage Route
    |--------------------------------------------------------------------------
    |
    | Routes that can only be accessible by Admins / Librarians (Depending on scenario)
    |
    */

    //Manage Route
    Route::prefix('manage', 'verified', 'isActive')->group(function () {

        //Admin
        Route::group(['middleware' => ['isAdmin']], function () {
            //Users
            Route::resource('users', 'UserController');

            //Datatable Routes
            Route::get('/dt/users', 'UserController@indexData')->name('users.index.data'); 
            Route::get('/dt/logs/user', 'LogUserController@indexData')->name('logs.user.data');
            Route::get('/dt/logs/book', 'LogBookController@indexData')->name('logs.book.data'); 
            Route::get('/dt/logs/patron', 'LogPatronController@indexData')->name('logs.patron.data');
            Route::get('/dt/logs/transaction', 'LogTransactionController@indexData')->name('logs.transaction.data');

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

        //Admin or Librarian
        Route::group(['middleware' => ['isAdminLibrarian']], function () {
            //Patrons
            Route::resource('patrons', 'PatronController');
            Route::get('/dt/patrons', 'PatronController@indexData')->name('patrons.index.data');
        });

        //Librarian
        Route::group(['middleware' => ['isLibrarian']], function () {

            //Book Controller
            Route::resource('books', 'BookController');

            //Datatable Routes
            Route::get('/dt/books', 'BookController@indexData')->name('books.index.data'); 
            Route::get('/dt/booksShow/{id}', 'BookController@showData')->name('books.show.data'); 
            Route::get('/dt/transactions', 'TransactionController@indexData')->name('transactions.index.data');
            Route::get('/dt/damage/{id}', 'BookController@indexDamageData')->name('damage.show.data');

            //Transaction Controller
            Route::prefix('transactions')->group(function () {
                Route::get('/', 'TransactionController@index')->name('transactions.index');
                Route::get('/create', 'TransactionController@create')->name('transactions.create');
                Route::post('/create/fetchPatron', 'TransactionController@fetchPatron');
                Route::post('/create/fetchBook', 'TransactionController@fetchBook');
                Route::get('/{id}', 'TransactionController@show')->name('transactions.show');
                Route::post('/create', 'TransactionController@store')->name('transactions.store');
                Route::get('/{id}/returnBook', 'TransactionController@returnBook')->name('transactions.returnBook');
                Route::post('/{id}/returnBook', 'TransactionController@returnBookStore')->name('transactions.returnBookStore');
            });
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
    
             //Admin Homepage
             Route::get('/', 'HomeController@Admin')->name('admin');         
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

    //Librarian Specific Routes
    Route::middleware('auth', 'verified', 'isLibrarian', 'isActive')->group(function() {
        //Librarian Route
        Route::prefix('librarian')->group(function () {
        
            //Librarian Homepage
            Route::get('/', 'HomeController@Librarian')->name('librarian');
        });
    });
});