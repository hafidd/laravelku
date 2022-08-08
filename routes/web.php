<?php

use App\Http\Controllers\UserController;
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

// /user/something
Route::prefix('user')->group(function () {
    // guest only
    Route::middleware('guest')->group(function () {
        Route::get('/login', [UserController::class, 'login'])->name('login');
        Route::get('/register', [UserController::class, 'register'])->name('register');
        Route::post('/auth', [UserController::class, 'auth'])->name('login_process');
        Route::post('/store', [UserController::class, 'store'])->name('register_process');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return "Profile page under construction";
        })->middleware('auth')->name('profile');
        Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
    });
});

// products
Route::prefix('product')->group(function () {
    Route::get('/', function () {
        return "products page";
    })->name('product');
});
