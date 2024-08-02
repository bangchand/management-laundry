<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Laravel\Ui\Presets\React;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\PaymentMethodRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        return view('payment_methods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status[1];

        PaymentMethod::create($validatedData);
        return redirect()->route('payment_methods.index')->with('success', 'Add payment method successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $payment_method)
    {
        return view('payment_methods.edit', compact('payment_method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status[1];

        $paymentMethod->update($validatedData);
        return redirect()->route('payment_methods.index')->with('success', 'Edit payment method successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        try {
            $paymentMethod->delete();
            return redirect()->route('payment_methods.index')->with('success', 'Delete payment_method successfull!');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('services.index')->with('error', 'Failed to delete data due to a database constraint. Please check if the data is in use or related to other records.');
            }
            return redirect()->route('services.index')->with('error', 'Fail delete data!');
        }
    }
}
