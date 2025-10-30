<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\TransaksiPenjualanController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/send-email/{to}/{id}', [TransaksiPenjualanController::class, 'sendEmail']);

//Auth Routes
route::get('/login', [AuthController::class, 'loginForm'])->name('login');
route::post('/login', [AuthController::class, 'login'])->name('login.process');

route::get('/register', [AuthController::class, 'registerForm'])->name('register');
route::post('/register', [AuthController::class, 'register'])->name('register.process');

route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route Protected by Login
route::middleware(['auth'])->group(function(){

    //Dashboard diakses kalau suda login
    route::get('/home', [HomeController::class, 'index'])->name('home');

    //Product
    route::resource('/products', ProductController::class);

    //Category Product
    route::resource('/categories', ProductController::class);

    //Supplier
    route::resource('/suppliers', SupplierController::class);

    //Transaksi Penjualan
    route::resource('/transaksis', TransaksiPenjualanController::class);
});