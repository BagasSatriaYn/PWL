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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Api\TransaksiController;
 
 
 Route::get('transaksis', [TransaksiController::class, 'index']);
 Route::post('transaksis', [TransaksiController::class, 'store']);
 Route::get('transaksis/{transaksi}', [TransaksiController::class, 'show']);
 Route::put('transaksis/{transaksi}', [TransaksiController::class, 'update']);
 Route::delete('transaksis/{transaksi}', [TransaksiController::class, 'destroy']);
