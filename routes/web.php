<?php

//Barcode Testing
Route::get('/barcode', function() {
    echo DNS1D::getBarcodeSVG("201600000012", "EAN13");
});

//Get rid of this.. eventually
Route::get('/', function () {
    return view('welcome');
});

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

//Patron Routes
Route::middleware('guest')->group(function() {

});

//Users Route
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

//Libarian Routes
Route::middleware('auth', 'verified', 'isLibarian')->group(function() {

});

//Admin Routes
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