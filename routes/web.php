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
Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/login');
});

Route::get('/', function(){
    return redirect('/home');
});

Route::middleware(['auth', 'role:administrator|user'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::middleware(['role:administrator|user'])->group(function(){

      //Accounts
      Route::prefix('accounts')->group(function(){
        Route::get('setting', 'AccountController@edit')->name('edit');
        Route::put('setting', 'AccountController@update')->name('update');
      });
    });
    // Administration
        Route::middleware(['auth', 'role:administrator'])->prefix('administration')->group(function(){
            // User Management
            Route::resource('users', 'UsersController', ['except' => [
                'show'
            ]]);
            Route::get('users/lists', 'UsersController@lists')->name('users.list');
            Route::get('users/lists/exportxls', 'UsersController@exportxls')->name('users.xls');
            Route::get('users/manage', 'UsersController@index')->name('users.manage');
        });
        // Master Data
        Route::prefix('ticketmanagement')->group(function(){
            
        });
});
