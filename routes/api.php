<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BooksLoansController;
use App\Http\Controllers\AuthController;

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


//Public Routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/users',[AuthController::class,'index']);
Route::get('/users/{id}',[AuthController::class,'show']);
Route::get('/users/search/{name}', [AuthController::class,'search']);

Route::get ('/books',[BooksController::class,'index']);
Route::get('/books/search/{name}', [BooksController::class,'search']);
Route::get ('/books/{id}',[BooksController::class,'show']);



//loan routes
Route::get ('/bookloans',[BooksLoansController::class,'index']);
Route::get('/bookloans/search/{name}', [BooksLoansController::class,'search']);
Route::get ('/bookloans/{id}',[BooksLoansController::class,'show']);
Route::get('/bookloans/loan-details', [BooksLoansController::class, 'getLoanDetails']);

//Route::resource('books',BooksController::class);
//Route::resource('bookscontroller', BooksController::class);
//Route::resource('bookloans',BooksLoansController::class);

Route::post ('/books',[BooksController::class,'store']);
Route::put ('/books/{id}',[BooksController::class,'update']);
Route::delete ('/books/{id}',[BooksController::class,'destroy']);

Route::group(['middleware'=>['auth:sanctum']],function (){

    //LOANS ROUTES
    Route::post ('/bookloans',[BooksLoansController::class,'store']);
    Route::put ('/bookloans/{id}',[BooksLoansController::class,'update']);
    Route::delete ('/bookloans/{id}',[BooksLoansController::class,'delete']);
    Route::post('/logout',[AuthController::class,'logout']);
    //Users Routes
    Route::put('/editUser/{id}',[AuthController::class,'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
