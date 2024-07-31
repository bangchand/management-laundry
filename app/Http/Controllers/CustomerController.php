<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $customers = Customer::orderBy('name', 'asc')
            ->where('name', 'like', '%' .  $search . '%')
            ->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $validatedData = $request->validated();

        // dd($validatedData);
        Customer::create($validatedData);
        return redirect()->route('customers.index')->with('success', 'add customer successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $validatedData = $request->validated();

        $customer->update($validatedData);
        return redirect()->route('customers.index')->with('success', 'edit customer successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer);
        return redirect()->route('customers.index')->with('success', 'delete customer successfull');
    }
}
