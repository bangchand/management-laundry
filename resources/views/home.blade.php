@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Total Customers') }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalCustomers }}</h5>
                                        <p class="card-text">Number of customers registered.</p>
                                        <a href="{{ route('customers.index') }}" class="btn btn-primary">View Customers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Total Services') }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalServices }}</h5>
                                        <p class="card-text">Number of services available.</p>
                                        <a href="{{ route('services.index') }}" class="btn btn-primary">View Services</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Total Transactions') }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalTransactions }}</h5>
                                        <p class="card-text">Number of transactions completed.</p>
                                        <a href="{{ route('transactions.index') }}" class="btn btn-primary">View
                                            Transactions</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Recent Payments') }}
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($recentPayments as $payment)
                                                <li class="list-group-item">
                                                    {{ $payment->transaction->customer->name }} - {{ $payment->amount }}
                                                    on {{ $payment->payment_date }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('payments.index') }}" class="btn btn-primary mt-3">View All
                                            Payments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Recent Transactions') }}
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($recentTransactions as $transaction)
                                                <li class="list-group-item">
                                                    {{ $transaction->customer->name }} - {{ $transaction->total_amount }}
                                                    on {{ $transaction->transaction_date }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('transactions.index') }}" class="btn btn-primary mt-3">View All
                                            Transactions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('Payment Method') }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $paymentMethod }}</h5>
                                        <p class="card-text">Payment Method available.</p>
                                        <a href="{{ route('payment_methods.index') }}" class="btn btn-primary">View
                                            Payment Method</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
