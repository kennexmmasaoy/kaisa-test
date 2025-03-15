<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BorrowerController;
use App\Models\BookCategoryModel;

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
Route::get('/',[BookCategoryController::class, 'index']);
Route::get('/book' ,[BookController::class, 'index']);
Route::get('/book/{data}' ,[BookController::class, 'addEditBook']);