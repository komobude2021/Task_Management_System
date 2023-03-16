<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\SearchController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AppController::class, 'index'])->name('login');
    Route::post('/', [AppController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/register', [AppController::class, 'register'])->name('register');
    Route::post('/register', [AppController::class, 'registerSubmit'])->name('registerSubmit');
});

Route::middleware(['PreventBackButton', 'auth'])->name('user.')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::post('/home', [UserController::class, 'update'])->name('update');
    Route::get('/github', [GithubController::class, 'index'])->name('github');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::resource('/task', TaskController::class);
    Route::post('/task/completed', [TaskController::class, 'completed'])->name('task.completed');
    Route::post('/logout', [AppController::class, 'logout'])->name('logout');
});



