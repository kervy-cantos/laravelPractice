<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\WorkersController;

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

Route::resource('/tasks', TasksController::class);
// Labor Routes//
Route::post('/addWorker','App\Http\Controllers\WorkersController@store');
Route::delete('/deleteWorker/{id}','App\Http\Controllers\WorkersController@destroy');
// Parts Routes//
Route::post('/addPart','App\Http\Controllers\PartsController@store');
Route::delete('/deletePart/{id}','App\Http\Controllers\PartsController@destroy');