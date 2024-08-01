<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

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

        return redirect()->route('payment_methods.index')->with('success', 'Edit payment method successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment_methods.index')->with('success', 'Delete payment_method successfull!');
    }
}
