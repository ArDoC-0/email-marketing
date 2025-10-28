<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index']);

       Route::resource('subscriber', SubscriberController::class);
