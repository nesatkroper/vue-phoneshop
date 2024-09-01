<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    public function getProductPhoto()
    {
        try {
            $pro = ProductPhoto::all();
            return response()->json($pro)->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }

    public function getOnlyProductPhoto(string $id)
    {
        try {
            $pro = ProductPhoto::all()->find($id);
            return response()->json($pro)->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }

    public function createProductPhoto(Request $request)
    {
        try {
            $path = null;
            if ($request->hasFile('photo')) {
                $img = $request->file('photo');
                $path = 'pro_photo' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('customer'), $path);
            }

            ProductPhoto::create([
                'photo' => $path,
                'pro_id' => $request->pro_id,
                'code' => $request->code,
            ]);

            return response()->json("success")->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }

    // public function (){
    //     try{
    //         return response()->json()->setStatusCode(200);
    //     }catch(\Exception $e){
    //         return response()->json($e)->setStatusCode(500);
    //     }
    // }

    // public function (){
    //     try{
    //         return response()->json()->setStatusCode(200);
    //     }catch(\Exception $e){
    //         return response()->json($e)->setStatusCode(500);
    //     }
    // }

    // public function (){
    //     try{
    //         return response()->json()->setStatusCode(200);
    //     }catch(\Exception $e){
    //         return response()->json($e)->setStatusCode(500);
    //     }
    // }

    // public function (){
    //     try{
    //         return response()->json()->setStatusCode(200);
    //     }catch(\Exception $e){
    //         return response()->json($e)->setStatusCode(500);
    //     }
    // }
}
