<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index']);

Route::middleware('auth')->group(function(){
    Route::post('/subscriber/create', [SubscriberController::class, 'store'])->name('subscriber.create');
});