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

// Route::get('/', function () {
//     return view('welcome');
// });

    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('create', 'TaskController@create')->name('tasks.create');
    Route::post('tasks', 'TaskController@store')->name('tasks.store');
    Route::get('show/{id}', 'TaskController@show')->name('tasks.show');
    Route::get('edit/{id}', 'TaskController@edit')->name('tasks.edit');
    Route::post('update', 'TaskController@update')->name('tasks.update');
    Route::get('delete/{id}', 'TaskController@destroy')->name('tasks.destroy');

    Route::prefix('projects')->group(function(){
        Route::get('/', 'ProjectController@index')->name('projects.index');
        Route::get('/create', 'ProjectController@create')->name('projects.create');
        Route::post('/projects', 'ProjectController@store')->name('projects.store');
        Route::get('/show/{id}', 'ProjectController@show')->name('projects.show');
        Route::get('/edit/{id}', 'ProjectController@edit')->name('projects.edit');
        Route::post('/edit/{id}', 'ProjectController@update')->name('projects.update');
        Route::get('/delete/{id}', 'ProjectController@destroy')->name('projects.destroy');
        Route::get('/tasks/{id}', 'ProjectController@taskshow')->name('projects.tasks');
    });


