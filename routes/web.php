<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin');
            Route::get('auction', [DashboardController::class, 'auction'])->name('admin.auction');
            Route::get('auction/{id}', [AuctionController::class, 'adminShow'])->name('admin.auction.show');
        });
    });

    Route::post('auction/bid', [AuctionController::class, 'bid'])->name('auction.bid');
    Route::post('auction/join', [AuctionController::class, 'join'])->name('auction.join');
    Route::delete('auction/leave', [AuctionController::class, 'leave'])->name('auction.leave');
    Route::resource('auction', AuctionController::class);
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Auth::routes();
