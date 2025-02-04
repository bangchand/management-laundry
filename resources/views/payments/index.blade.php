@extends('layouts.main')

@section('title', 'Data Customer')

@section('content')

    <div class="d-flex align-items-center mb-3">
        <h3>Data Payment</h3>
    </div>

    {{-- <form action="{{ route('payments.index') }}">
        <input type="date" name="start" value="{{ request('start') }}">
        <input type="date" name="end" value="{{ request('end') }}">

        <button type="submit">Find</button>
    </form> --}}

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Services</th>
                <th>Payment Method</th>
                <th>Payment Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $payment->transaction->customer->name }}</td>
                    <td>{{ $payment->transaction->service->name }}</td>
                    <td>{{ $payment->payment_method->name }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->amount }}</td>
                </tr>
            @empty
                <td>
                    tidak ada data.
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @endforelse
        </tbody>
    </table>
@endsection
