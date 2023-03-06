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

Route::get('/welcome', function () {
    return view('welcome');
});

use App\Http\Controllers\TestController;

use App\Http\Controllers\BlogController;
//Route::get('/about', [TestController::class, 'index']);
//Route::get('/home', [TestController::class, 'homePage']);

//Route::get('/folder/home', [BlogController::class, 'index']);
Route::get('/', [BlogController::class, 'index']);
Route::get('/home', [BlogController::class, 'index']);
Route::get('/about', [BlogController::class, 'about']);
Route::get('/message', [BlogController::class, 'message']);
Route::get('/contact', [BlogController::class, 'contact']);
Route::post('/contact', [BlogController::class, 'formContact']);