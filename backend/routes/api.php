<?php

use App\Http\Controllers\api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as route;

route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::get('/cus.get', [CustomerController::class, 'getCustomer']);
route::get("/cus.only/{id}", [CustomerController::class, 'getCustomerById']);
route::post('/cus.create', [CustomerController::class, 'createCustomer']);
route::put('/cus.update/{id}', [CustomerController::class, 'updateCustomer']);
route::delete('/cus.delete/{id}', [CustomerController::class, 'deleteCustomer']);
