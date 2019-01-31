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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('upload-image','Home\UploadController@image')->name('common.upload.image');

Route::get('pindan','Home\ShareTheBillController@lists')->name('home.pindan.lists');
Route::get('order/detail','Home\ShareTheBillController@orderDetail')->name('home.pindan.detail');
