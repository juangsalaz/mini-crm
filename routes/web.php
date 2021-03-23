<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardsController::class, 'index'])->name('dashboard');

    // Brand Route
    Route::get('/brand', [BrandsController::class, 'index'])->name('brand');
    Route::get('/brand/add', [BrandsController::class, 'add'])->name('add-brand');
    Route::post('/brand/store', [BrandsController::class, 'store'])->name('store-brand');
    Route::get('/brand/edit/{id}', [BrandsController::class, 'edit'])->name('edit-brand');
    Route::post('/brand/update/{id}', [BrandsController::class, 'update'])->name('update-brand');
    Route::post('/brand/delete/{id}', [BrandsController::class, 'delete'])->name('delete-brand');
    
    Route::get('/product', [ProductsController::class, 'index'])->name('product');
    Route::get('/product/add', [ProductsController::class, 'add'])->name('add-product');
    Route::post('/product/store', [ProductsController::class, 'store'])->name('store-product');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('edit-product');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('update-product');
    Route::post('/product/delete/{id}', [ProductsController::class, 'delete'])->name('delete-product');
});
