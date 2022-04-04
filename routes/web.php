<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['visited']], function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::prefix('admin')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('admin');
                Route::get('auction', [DashboardController::class, 'auction'])->name('admin.auction');
                Route::get('auction/{id}', [AuctionController::class, 'adminShow'])->name('admin.auction.show');
                Route::get('user', [DashboardController::class, 'user'])->name('admin.user');
            });
        });

        Route::group(['middleware' => ['user']], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
        });

        Route::post('auction/bid', [AuctionController::class, 'bid'])->name('auction.bid');
        Route::post('auction/join', [AuctionController::class, 'join'])->name('auction.join');
        Route::delete('auction/leave', [AuctionController::class, 'leave'])->name('auction.leave');
        Route::delete('auction/bid/destroy/{id}', [AuctionController::class, 'bidDestroy'])->name('auction.bid.destroy');
        Route::delete('auction/member/destroy/{auctionId}/{userId}', [AuctionController::class, 'memberDestroy'])->name('auction.member.destroy');
        Route::get('search', [AuctionController::class, 'search'])->name('search');
        Route::resource('auction', AuctionController::class);
        Route::get('/search', [AuctionController::class, 'search'])->name('search');
    });

    Route::group(['middleware' => ['nonvisited']], function () {
        Route::get('/terms-and-conditions', function () {
            return view('pages.home.info');
        });
    });
});

Auth::routes();
