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

// Messages sent routes
Route::get('admin/messages/sent', 'Admin\MessagesSentController@index')->name('admin.sent.index');

// Messages trash routes
Route::get('admin/messages/trash', 'Admin\MessagesTrashController@index')->name('admin.trash.index');
Route::put('admin/messages/restore/{message}', 'Admin\MessagesTrashController@update')->name('admin.trash.update');

// Messages reply routes
Route::put('admin/messages/reply/{message}', 'Admin\MessagesReplyController@update')->name('admin.reply.update');

// Messages inbox routes
Route::get('admin/messages', 'Admin\MessagesInboxController@index')->name('admin.messages.index');
Route::get('admin/messages/create', 'Admin\MessagesInboxController@create')->name('admin.messages.create');
Route::post('admin/messages', 'Admin\MessagesInboxController@store')->name('admin.messages.store');
Route::get('admin/messages/{message}', 'Admin\MessagesInboxController@show')->name('admin.messages.show');
Route::put('admin/messages/{message}', 'Admin\MessagesInboxController@update')->name('admin.messages.update');
Route::get('admin/messages/{message}/edit', 'Admin\MessagesInboxController@edit')->name('admin.messages.edit');
Route::delete('admin/messages/{message}', 'Admin\MessagesInboxController@destroy')->name('admin.messages.destroy');

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
