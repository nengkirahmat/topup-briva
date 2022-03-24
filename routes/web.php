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



// Auth::routes(['register' => false]);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::post('/topup', [App\Http\Controllers\TopUpController::class, 'store'])->name('topup');
    Route::get('/get-history', [App\Http\Controllers\HomeController::class, 'getHistory'])->name('list-history');
    Route::post('/update-user', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('update-user');
});

