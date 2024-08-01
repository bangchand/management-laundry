@extends('layouts.main')

@section('title', 'Add Customer')

@section('content')
    <div class="px-5">
        <h3>Create Transaction</h3>
        <form action="{{ route('transactions.store') }}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="status" value="on proggres">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Name :</label>
                <select class="js-example-basic-single form-control" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label">Name :</label>
                <select class="js-example-basic-single form-control" name="service_id">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total_amount" class="form-label">Total Amount :</label>
                <input type="number" class="form-control" value="{{ old('total_amount') }}" name="total_amount">
                @error('total_amount')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Transaction</button>
            <a href="{{ route('transactions.index') }}"><button type="button" class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
