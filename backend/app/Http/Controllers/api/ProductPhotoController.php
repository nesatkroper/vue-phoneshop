<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    public function getProductPhoto()
    {
        try {
            $pro = Product::all();
            $pphoto = DB::table('product_photos')
                ->leftjoin('products', 'product_photos.pro_id', '=', 'products.id')
                ->select('product_photos.*', 'products.name as pro_name')->get();
            return response()->json([$pro, $pphoto])->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }

    public function getOnlyProductPhoto(string $id)
    {
        try {
            $pro = DB::table('product_photos')
                ->leftjoin('products', 'product_photos.pro_id', '=', 'products.id')
                ->select('product_photos.*', 'products.name as pro_name')->where('product_photos.id', '=', $id)->get();


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
                $img->move(public_path('pro_photo'), $path);
            }

            ProductPhoto::create([
                'photo' => $path,
                'pro_id' => $request->pro_id,
                'code' => 'brand00' . $request->code,
            ]);

            return response()->json("success")->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json($e)->setStatusCode(500);
        }
    }

    public function deleteProductPhoto(string $id)
    {
        try {
            $pro = ProductPhoto::findOrFail($id);
            $img = $pro->photo;
            $file = public_path('pro_photo/' . $img);
            File::delete($file);
            $pro->delete();
            return response()->json('Product Photo Delete Successfully')->setStatusCode(200);
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
}
