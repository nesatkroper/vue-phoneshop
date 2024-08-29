<?php

use App\Http\Controllers\api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/cus.get', [CustomerController::class, 'getCustomer']);
Route::get("/cus.only/{get}", [CustomerController::class, 'getCustomerById']);
Route::post('/cus.create', [CustomerController::class, 'createCustomer']);
Route::put('/cus.update/{put}', [CustomerController::class, 'updateCustomer']);
Route::delete('/cus.delete/{delete}', [CustomerController::class, 'deleteCustomer']);
