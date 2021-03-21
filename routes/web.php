<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/messages', function () {
    return view('messages');
})->name('messages');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit','ContactController@submit')->name('contact-form');
Route::post('/contact/update/{id}','ContactController@update')->name('contact-update');
Route::get('/contact/messages','ContactController@allmessages')->name('all_messages');
Route::get('/contact/message/{id}','ContactController@one_message')->name('one-message');
Route::get('/contact/message_edit/{id}','ContactController@one_message_edit')->name('one-message-edit');
Route::get('/contact/message_delete/{id}','ContactController@one_message_delete')->name('one-message-delete');
Route::get('/messages_1','ContactController@filters')->name('message-filters');
//работаем с камерами
Route::get('/ipc/all','IpcController@all_cameras')->name('ipc.all');
Route::get('/ipc/filtered','IpcController@filters')->name('ipc.filters');
Route::get('/ipc/add', 'IpcController@cam_add_form')->middleware('auth.basic')->name('ipc.form');
Route::post('/ipc/add', 'IpcController@cam_add')->middleware('auth.basic')->name('ipc.add');
Route::get('/ipc/one/{id}','IpcController@cam_one')->name('ipc.one');
Route::get('/ipc/one/edit/{id}','IpcController@cam_edit')->middleware('auth.basic')->name('ipc.edit');
Route::post('/ipc/one/update/{id}','IpcController@cam_update')->middleware('auth.basic')->name('ipc.update');
Route::get('/ipc/one/delete/{id}','IpcController@cam_delete')->middleware('auth.basic')->name('ipc.one.delete');
Route::get('/ipc/onEachSide/copy/{id}','IpcController@cam_copy')->middleware('auth.basic')->name('ipc.one.copy');

//работаем со складом
Route::get('/ipc/stock','StockController@stock_fill')->middleware('auth.basic')->name('stock.fill');
Route::post('/ipc/stock','StockController@stock_pull')->middleware('auth.basic')->name('stock.pull');
//аутентификация
Route::get('/login','IpcController@all_cameras')->middleware('auth.basic')->name('login');
Route::get('/logout', 'IpcController@logout')->name('logout');
