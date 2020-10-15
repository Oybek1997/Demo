<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;
use App\Documents;
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

Route::redirect('/', '/documents');
    Route::resource('documents','App\Http\Controllers\DocumentsController');
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\DocumentsController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get("/piechart", "App\Http\Controllers\EchartController@echart");
