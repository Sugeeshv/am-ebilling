<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
    // product management
    Route::get('product/manage', [ProductController::class, 'index'])->name('product.view');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('route/manage',[RouteController::class,'index'])->name('route.view');
    Route::post('route/store',[RouteController::class,'store'])->name('route.store');
    Route::post('route/sub/store',[RouteController::class,'substore'])->name('route.sub.store');
    Route::get('route/sub/delete/{id}',[RouteController::class,'subdelete'])->name('route.sub.delete');
    Route::post('route/sub/update/{id}',[RouteController::class,'subupdate'])->name('route.sub.update');
    Route::post('route/update',[RouteController::class,'updates'])->name('route.update');
    Route::get('route/destroy/{id}',[RouteController::class,'delete'])->name('route.delete');

    // Route::post('outlet/route/create',[RouteController::class,'outlet_route_create'])->name('outlet.route.create');
    // Route::get('outlet/route',[RouteController::class,'outlet_route_index'])->name('outlet.route.view');
    // Route::get('outlet/destroy/{id}',[RouteController::class,'outlet_route_distroy'])->name('outlet.route.distroy');

    Route::get('add/stock/{id}',[StockController::class,'add_stock'])->name('add.stock');
    Route::post('create/stock/',[StockController::class,'create_stock'])->name('create.stock');
    Route::get('delete/stock/{id}',[StockController::class,'delete_stock'])->name('stock.delete');
    Route::get('stock',[StockController::class,'index'])->name('stock');
    Route::post('filter',[HomeController::class,'filter'])->name('filter.stocks');
    Route::post('filterstock',[StockController::class,'filterstock'])->name('stocks.filter');
});