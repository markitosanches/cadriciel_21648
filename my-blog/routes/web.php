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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;

Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create');
Route::post('blog-create', [BlogPostController::class, 'store']);
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update']);
Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy']);
Route::get('page', [BlogPostController::class, 'page']);

Route::get('query', [BlogPostController::class, 'query']);

Route::get('register', [CustomAuthController::class, 'create'])->name('auth.create');
Route::post('register', [CustomAuthController::class, 'store'])->name('auth.create');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('authentication', [CustomAuthController::class, 'authentication'])->name('authentication');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('user-list', [CustomAuthController::class, 'userList'])->name('user.list')->middleware('auth');


