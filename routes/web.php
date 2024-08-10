<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');