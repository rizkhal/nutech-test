<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class)->except(['create', 'edit', 'update']);
// inertia uploading file must be using post
Route::post('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
