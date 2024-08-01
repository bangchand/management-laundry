@extends('layouts.main')

@section('title', 'Edit Transaction')

@section('content')
    <div class="px-5">
        <h3>Edit Transaction</h3>
        <form action="{{ route('transactions.update', $transaction->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer :</label>
                <select class="js-example-basic-single form-control" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Service :</label>
                <select class="js-example-basic-single form-control" name="service_id">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id', $transaction->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
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
                <input type="number" class="form-control" name="total_amount"
                    value="{{ old('total_amount', $transaction->total_amount) }}">
                @error('total_amount')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Transaction</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
