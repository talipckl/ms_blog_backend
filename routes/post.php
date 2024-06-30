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
Route::prefix('category')
    ->name('.category')
    ->controller(\App\Http\Controllers\CategoryController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

Route::controller(\App\Http\Controllers\PostController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{slug}', 'show')->name('show');
        Route::post('/', 'store')->name('store')->middleware('auth.user')->middleware('checkDailyPostLimit');
        Route::put('/update/{post}', 'update')->name('update')->middleware('auth.user');
        Route::delete('/delete/{post}', 'destroy')->name('destroy')->middleware('auth.user');
    });
