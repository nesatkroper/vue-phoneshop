<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\PhoneModelController;
use App\Http\Controllers\api\ProductPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as route;

route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CUSTOMER ROUTES
route::get('/customer', [CustomerController::class, 'getCustomer']);
route::get("/customer/{id}", [CustomerController::class, 'getOnlyCustomer']);
route::post('/customer', [CustomerController::class, 'createCustomer']);
route::put('/customer/{id}', [CustomerController::class, 'updateCustomer']);
route::delete('/customer/{id}', [CustomerController::class, 'deleteCustomer']);

// BRAND ROUTES
route::get('/brand', [PhoneModelController::class, 'getPhoneModel']);
route::get('/brand/{id}', [PhoneModelController::class, 'getOnlyPhoneModel']);
route::post('/brand', [PhoneModelController::class, 'createPhoneModel']);

// PRODUCT PHOTO ROUTES
route::get('/photo', [ProductPhotoController::class, 'getProductPhoto']);
route::get('/photo/{id}', [ProductPhotoController::class, 'getOnlyProductPhoto']);
route::post('/photo', [ProductPhotoController::class, 'createProductPhoto']);
route::put('/photo', [ProductPhotoController::class, 'getProductPhoto']);
route::delete('/photo/{id}', [ProductPhotoController::class, 'deleteProductPhoto']);
