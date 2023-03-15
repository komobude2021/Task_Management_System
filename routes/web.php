<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\TaskController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AppController::class, 'index'])->name('login');
    Route::post('/', [AppController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/register', [AppController::class, 'register'])->name('register');
    Route::post('/register', [AppController::class, 'registerSubmit'])->name('registerSubmit');
});

Route::middleware(['auth'])->name('user.')->group(function () {

    Route::get('/github', [TaskController::class, 'github'])->name('github');
    Route::post('/logout', [AppController::class, 'logout'])->name('logout');
});



