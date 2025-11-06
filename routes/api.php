<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;

Route::prefix('suppliers')->group(function (){
    Route::get('/lihat', [SupplierController::class, 'lihat']);
    Route::get('/lihat/{id}', [SupplierController::class, 'lihat_by']);
});

Route::prefix('products')->group(function (){
    Route::get('/lihat', [ProductController::class, 'lihat']);
    Route::get('/lihat/{id}', [ProductController::class, 'lihat_by']);
});

Route::apiResource('users', CobaController::class);
Route::post('login', [CobaController::class, 'login']);

Route::get('test', function(){
    return response()->json(['massage'=>'Api is Working!']);
});
