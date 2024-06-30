<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')
    ->name('.auth')
    ->controller(\App\Http\Controllers\AuthController::class)
    ->group(function (){
       Route::post('/signup','signup')->name('signup');
       Route::post('/login','signin')->name('login');
       Route::get('/me','me')->name('me')->middleware('auth.user');
       Route::post('/logout','logout')->name('logout')->middleware('auth.user');
    });
