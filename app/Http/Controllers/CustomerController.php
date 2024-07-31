<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::all();
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
        try {
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Delete customer successfull!');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('customers.index')->with('error', 'Failed to delete data due to a database constraint. Please check if the data is in use or related to other records.');
            }
            return redirect()->route('customers.index')->with('error', 'Fail delete data!');
        }
    }
}
