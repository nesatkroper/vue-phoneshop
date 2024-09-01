<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PhoneModel;
use Illuminate\Http\Request;

class PhoneModelController extends Controller
{
    public function getPhoneModel()
    {
        try {
            $brand = PhoneModel::all();
            $cus = Customer::all();
            return response()->json([
                $brand,
                $cus
            ]);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }
    public function getOnlyPhoneModel(string $id)
    {
        try {
            $brand = PhoneModel::all()->find($id);
            return response()->json($brand);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }
    public function createPhoneModel(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
                'code' => 'required',
            ]);

            $path = null;
            if ($request->hasFile('photo')) {
                $img = $request->file('photo');
                $path = 'brand' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('customer'), $path);
            }
            PhoneModel::create([
                'name' => $validate['name'],
                'photo' => $path,
                'code' => $validate['code'],
                'desc' => ' ' . $request->desc,
            ]);
            return response()->json("success create phone model");
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }
    public function updatePhoneModel(Request $req, string $id)
    {
        try {
            return response()->json();
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }
    public function deletePhoneModel(string $id)
    {
        try {
            return response()->json();
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }
    // public function (){
    //     try{
    //         return response()->json();
    //     }catch(\Exception $e){
    //         return response()->json($e)->setStatusCode(500);
    //     }
    // }
}
