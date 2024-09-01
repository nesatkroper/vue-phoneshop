<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\PhoneModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as route;

route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CUSTOMER ROUTES
route::get('/cus.get', [CustomerController::class, 'getCustomer']);
route::get("/cus.only/{id}", [CustomerController::class, 'getOnlyCustomer']);
route::post('/cus.post', [CustomerController::class, 'createCustomer']);
route::put('/cus.put/{id}', [CustomerController::class, 'updateCustomer']);
route::delete('/cus.delete/{id}', [CustomerController::class, 'deleteCustomer']);

// BRAND ROUTES
route::get('/brand.get', [PhoneModelController::class, 'getPhoneModel']);
route::get('/brand.only/{id}', [PhoneModelController::class, 'getOnlyPhoneModel']);
route::post('/brand.post', [PhoneModelController::class, 'createPhoneModel']);
