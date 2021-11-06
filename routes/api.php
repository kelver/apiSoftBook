<?php

use App\Http\Controllers\Api\{
    AuthController,
    BooksController,
};
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/', function(){
    return response()->json([
        'message' => 'success'
    ]);
});

Route::group(['middleware' => ['apiJwt']], function () {
    Route::put('/books/{identify}', [BooksController::class, 'update']);
    Route::delete('/books/{identify}', [BooksController::class, 'destroy']);
    Route::get('/books/{identify}', [BooksController::class, 'show']);
    Route::post('/books', [BooksController::class, 'store']);
    Route::get('/books', [BooksController::class, 'index']);
});
