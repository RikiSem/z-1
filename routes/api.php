<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('/employee')->group(function () {
    Route::post('/add', [ApiController::class, 'createEmployee']);
});
Route::prefix('/transaction')->group(function () {
    Route::post('/add', [ApiController::class, 'addTransaction']);
    Route::get('/get', [ApiController::class, 'getTransactions']);
});
Route::post('/payMoney', [ApiController::class, 'payMoney']);
