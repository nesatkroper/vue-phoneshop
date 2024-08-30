<?php

namespace App\Http\Controllers\api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomer()
    {
        try {
            $customers = Customer::all();
            return response()->json($customers);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function getCustomerById(string $id)
    {
        try {
            $customers = Customer::all()->find($id);
            return response()->json($customers);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function createCustomer(Request $request)
    {
        try {
            $path = null;
            if ($request->hasFile('photo')) {
                $img = $request->file('photo');
                $path = 'customers' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('customer'), $path);
            }

            Customer::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $path
            ]);
            return response()->json('Customer created successfully');
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function updateCustomer(Request $request, string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,

            ]);

            return response()->json('Customer updated successfully');
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function deleteCustomer(string $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json('Customer deleted successfully');
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }
}