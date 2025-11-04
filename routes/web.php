<?php

use App\Http\Controllers\Broadcast\BroadcastController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Subscriber\ImportSubscriberController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('subscriber/import', ImportSubscriberController::class)->name('subscriber.import');
    
});
Route::resource('broadcast', BroadcastController::class);

    Route::resource('subscriber', SubscriberController::class);