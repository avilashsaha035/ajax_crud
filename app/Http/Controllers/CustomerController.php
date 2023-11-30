<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function addCustomer()
    {
        return view('addcustomer');
    }

    //Insert
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'age' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()], 422);
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $customer = new Customer();
            $customer->full_name = $request->input('name');
            $customer->age = $request->input('age');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->save();
            return response()->json(['success' => 'Inserted successfully']);
        }
    }

    //Show
    public function show()
    {
        $customers = Customer::all();

        return response()->json(['customers' => $customers]);
    }

    //Edit
    public function edit($id)
    {
        $customers = Customer::find($id);

        return response()->json(['customers' => $customers]);
    }

    //Update
    public function update(Request $request)
    {
        $customers = Customer::find($request->id);

        $customers->full_name = $request->name;
        $customers->age = $request->age;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        $customers->save();
        // $customers = Customer::find($id);
        // $customers->update([
        //     'full_name' => $request->u_name,
        //     'age' => $request->u_age,
        //     'email' => $request->u_email,
        //     'phone' => $request->u_phone
        // ]);

        return response()->json(['success' => "Updated Successfully"]);
    }

    //Delete
    public function delete($id)
    {
        $customers = DB::table('customers')->where('id', $id)->delete();
        if (!$customers) {
            return response()->json(['message' => 'Not found'], 404);
        }

        // $customers->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }
}
