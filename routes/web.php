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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/show-document', 'HomeController@show')->name('show.document');
Auth::routes();
Route::group(['prefix' => 'admin'], function (){

    Route::get('/', 'FolderController@index')->name('backend.home')->middleware('auth');

    Route::group(['middleware' => 'auth'], function () {

        Route::get('search-modal', 'FolderController@searchModal')->name('search.modal');
        Route::get('change-category-children', 'FolderController@categoryChildren')->name('category.children');
        Route::get('search-result', 'FolderController@searchResult')->name('search.result');
        Route::get('create-file-modal', 'FolderController@createFileModal')->name('create.file.modal');
        Route::resource('folders', 'FolderController');
        Route::resource('files', 'FileController');

        Route::get('table-list', function () {
            return view('pages.table_list');
        })->name('table');

        Route::get('typography', function () {
            return view('pages.typography');
        })->name('typography');

        Route::get('icons', function () {
            return view('pages.icons');
        })->name('icons');

        Route::get('map', function () {
            return view('pages.map');
        })->name('map');

        Route::get('notifications', function () {
            return view('pages.notifications');
        })->name('notifications');

        Route::get('rtl-support', function () {
            return view('pages.language');
        })->name('language');

        Route::get('upgrade', function () {
            return view('pages.upgrade');
        })->name('upgrade');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('user', 'UserController', ['except' => ['show']]);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    });
});
