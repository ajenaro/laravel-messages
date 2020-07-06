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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('admin/messages', 'Admin\MessagesController@store')->name('admin.messages.store');
Route::get('admin/messages', 'Admin\MessagesController@index')->name('admin.messages.index');

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['auth']
    ],

    function () {
        Route::get('/', 'AdminController@index')->name('admin');

        Route::resource('users', 'UsersController', ['as' => 'admin']);
    }
);
