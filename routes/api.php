<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PaymentController;
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

Route::post('/auth/register', [UserController::class,'createUser']);
Route::post('/auth/login', [UserController::class,'loginUser']);

//Auth routes
Route::group(['middleware'=> 'auth:sanctum'], function () {
    Route::post('/auth/logout', [UserController::class,'logout']);
    Route::post('/auth/changePassword', [UserController::class,'changePassword']);

    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('genres', GenreController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('payment', PaymentController::class);
});