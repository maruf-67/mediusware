<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [TransactionController::class, 'index'])->name('home');

Route::prefix('transactions')->name('transactions.')->controller(TransactionController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/deposit', 'deposit')->name('deposit');
    Route::post('/deposit/store', 'depositStore')->name('deposit.store');
    Route::get('/withdraw', 'withdraw')->name('withdraw');
    Route::post('/withdraw/store', 'withdrawStore')->name('withdraw.store');
    Route::get('/withdraw/data', 'getData')->name('get');

});
