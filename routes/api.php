<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1/')->group(function(){
    Route::post('/create',[TransactionController::class,'create'])->name('create.transaction');
    Route::get('/show/{user}/transactionslist',[TransactionController::class,'showTransactions'])->name('show.transactionlist');
});
Route::post('/create',[TransactionController::class,'create'])->name('create.transaction');
Route::get('/show/{user}/transactionslist',[TransactionController::class,'showTransactions'])->name('show.transactionlist');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
