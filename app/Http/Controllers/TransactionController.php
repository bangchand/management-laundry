<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\TransactionRequest;
use Illuminate\Auth\Events\Validated;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('status', 'desc')->get();
        $payment_methods = PaymentMethod::where('status', 'available')->get();
        return view('transactions.index', compact('transactions', 'payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('transactions.create', compact('customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $validatedData = $request->validated();
        $service = Service::findOrFail($request['service_id']);
        $validatedData['current_price'] = $service->price;

        Transaction::create($validatedData);
        return redirect()->route('transactions.index')->with('success', 'Add transaction successfull!');
    }

    public function cancel($transaction)
    {
        $transaction = Transaction::findOrFail($transaction);
        $transaction->update([
            'status' => 'cancelled'
        ]);
        return redirect()->route('transactions.index')->with('success', 'Cancel transaction successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('transactions.edit', compact('customers', 'services', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $validatedData = $request->validated();
        $service = Service::findOrFail($request['service_id']);
        $validatedData['current_price'] = $service->price;

        $transaction->update($validatedData);
        return redirect()->route('transactions.index')->with('success', 'Edit transaction successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->route('transactions.index')->with('success', 'Delete transaction successfull!');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('services.index')->with('error', 'Failed to delete data due to a database constraint. Please check if the data is in use or related to other records.');
            }
            return redirect()->route('services.index')->with('error', 'Fail delete data!');
        }
    }
}
