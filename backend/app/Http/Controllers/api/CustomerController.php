<?php

namespace App\Http\Controllers\api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function getCustomer()
    {
        try {
            $customers = Customer::all();
            if ($customers != '[]') {
                return response()->json(
                    $customers,
                );
            } else {
                return response()->json([
                    'message' => 'no data',
                ], 404);
            }
        } catch (\Exception $exception) {
            return response()->json($exception)->setStatusCode(500);
        }
    }

    public function getOnlyCustomer(string $id)
    {
        try {
            $customers = Customer::all()->find($id);
            if ($customers != '[]') {
                return response()->json(
                    $customers,
                );
            } else {
                return response()->json([
                    'message' => 'no data',
                ], 404);
            }
        } catch (\Exception $exception) {
            return response()->json($exception)->setStatusCode(500);
        }
    }

    public function createCustomer(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]);

            $path = null;
            if ($request->hasFile('photo')) {
                $img = $request->file('photo');
                $path = 'customers' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('customer'), $path);
            }

            Customer::create([
                'name' => $validate['name'],
                'gender' => $validate['gender'],
                'email' => $validate['email'],
                'phone' => $validate['phone'],
                'address' => $validate['address'],
                'photo' => $path
            ]);
            return response()->json('Customer created successfully');
        } catch (\Exception $exception) {
            return response()->json($exception)->setStatusCode(500);
        }
    }

    public function updateCustomer(Request $request, string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $validate = $request->validate([
                'name' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
                'photo' => 'required'
            ]);

            $path = $customer->photo;
            if ($request->hasFile('photo')) {
                $old = public_path('customer/' . $path);
                File::delete($old);
                $img = $request->file('photo');
                $path = 'customers' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('customer'), $path);
            }

            $customer->update([
                'name' => $validate['name'],
                'gender' => $validate['gender'],
                'email' => $validate['email'],
                'phone' => $validate['phone'],
                'address' => $validate['address'],
                'photo' => $path,
            ]);

            return response()->json('Customer updated successfully');
        } catch (\Exception $exception) {
            return response()->json($exception)->setStatusCode(500);
        }
    }

    public function deleteCustomer(string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $img = $customer->photo;
            $file = public_path('customer/' . $img);
            File::delete($file);
            $customer->delete();
            return response()->json('Customer deleted successfully');
        } catch (\Exception $exception) {
            return response()->json($exception)->setStatusCode(500);
        }
    }
}
