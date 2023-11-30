<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //Insert
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $transaction = new Transaction();

            $transaction->customer_id = $request->input('id');
            $transaction->invoice = $request->input('invoice');
            $transaction->amount = $request->input('amount');
            $transaction->save();
            return response()->json(['message' => 'Inserted successfully']);
        }
    }
}
