<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/load/{type}', [BookCategoryController::class, 'getAllData']);
Route::post('/insert/{type}', [BookCategoryController::class, 'saveBookCategory']);
Route::get('/edit/{type}',[BookCategoryController::class, 'getData']);
Route::post('/update/{type}',[BookCategoryController::class, 'updateBookCategory']);
Route::get('/delete/{type}', [BookCategoryController::class, 'deleteBookCategory']);