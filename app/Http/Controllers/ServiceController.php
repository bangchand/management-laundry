<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Exception;
use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $validatedData = $request->validated();

        Service::create($validatedData);
        return redirect()->route('services.index')->with('success', 'Add service successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $validatedData = $request->validated();

        $service->update($validatedData);
        return redirect()->route('services.index')->with('success', 'Edit service successfull!');
    }

    public function showDelete()
    {
        $services = Service::onlyTrashed()->get();
        return view('services.deleted', compact('services'));
    }

    public function restore($id)
    {
        $service = Service::withTrashed()->find($id);
        $service->restore();
        return redirect()->route('services.deleted')->with('success', 'restore service successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Delete service successfull!');
    }

    public function delete($id)
    {
        try {
            $service = Service::withTrashed()->find($id);
            $service->forceDelete();
            return redirect()->route('services.deleted')->with('success', 'Delete service successfull!');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('services.deleted')->with('error', 'Failed to delete data due to a database constraint. Please check if the data is in use or related to other records.');
            }
            return redirect()->route('services.deleted')->with('error', 'Fail delete data!');
        }
    }
}
