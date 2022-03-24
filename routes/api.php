<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/briva-create', [App\Http\Controllers\BrivaController::class, 'create']);
Route::get('/briva-get-data', [App\Http\Controllers\BrivaController::class, 'getData']);
Route::get('/briva-get-status', [App\Http\Controllers\BrivaController::class, 'getStatus']);
Route::get('/briva-get-report-date', [App\Http\Controllers\BrivaController::class, 'getReportDate']);
