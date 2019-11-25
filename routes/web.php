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
Route::middleware(['auth'])->group(function () {
    
    Route::get('/', function () {
        return redirect('/task');
    });
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('task')->group(function(){
        Route::get('', 'TaskController@index');
        Route::post('/create','TaskController@store');
        Route::get('/update/{id}/{status}','TaskController@update');
        Route::get('/editTask/{id}','TaskController@editTask');
        Route::post('/updateTask/{id}','TaskController@updateTask');
        Route::get('/delete/{id}','TaskController@delete');
    });
});