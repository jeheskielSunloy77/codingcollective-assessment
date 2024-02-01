<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);

        $transactions = Transaction::with('user')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Transaction List',
            'data' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Transaction::class);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:withdraw,deposit'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator, response()->json([
                'status' => 2,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422));
        }

        $transaction = Transaction::create($validator->validated());
        return response()->json([
            'status' => 1,
            'message' => 'Transaction Stored',
            'data' => $transaction
        ]);
    }

    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return response()->json([
            'status' => 1,
            'message' => 'Transaction Detail',
            'data' => $transaction
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $validator = Validator::make($request->all(), [
            'amount' => 'numeric|min:1',
            'type' => 'in:withdraw,deposit'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator, response()->json([
                'status' => 2,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422));
        }

        $transaction->update($validator->validated());

        return response()->json([
            'status' => 1,
            'message' => 'Transaction Updated',
            'data' => $transaction
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Transaction Deleted',
            'data' => $transaction
        ]);
    }
}
