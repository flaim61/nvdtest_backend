<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::prefix('film')->controller(FilmController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'create')->middleware('auth');
    Route::post('/update', 'update')->middleware('auth');
    Route::post('/delete', 'delete')->middleware('auth');
});
