<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/attendance');
});

Route::get('/attendance', [App\Http\Controllers\HrdController::class, 'index']);
Route::get('/absent', [App\Http\Controllers\HrdController::class, 'absent']);
Route::get('/comelate', [App\Http\Controllers\HrdController::class, 'comelate']);
Route::get('/absen-masuk', [App\Http\Controllers\HrdController::class, 'absmasuk']);
Route::post('/recheckin', [App\Http\Controllers\HrdController::class, 'recheckin']);
Route::get('/cuti', [App\Http\Controllers\HrdController::class, 'cuti']);
Route::post('/save-cuti', [App\Http\Controllers\HrdController::class, 'savecuti']);
