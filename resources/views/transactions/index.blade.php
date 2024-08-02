@extends('layouts.main')

@section('title', 'Data Transaction')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3>Data Transaction</h3>
        <a href="{{ route('transactions.create') }}">
            <button class="btn btn-primary">Add</button>
        </a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->service->name }}</td>
                    <td>{{ $transaction->current_price }}</td>
                    <td>{{ $transaction->total_amount }}</td>
                    <td>
                        @if ($transaction->status === 'on proggres')
                            <span class="badge rounded-pill text-bg-warning">On Progress</span>
                        @elseif ($transaction->status === 'completed')
                            <span class="badge rounded-pill text-bg-success">Completed</span>
                        @elseif ($transaction->status === 'cancelled')
                            <span class="badge rounded-pill text-bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        @if ($transaction->status === 'on proggres')
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#payment{{ $transaction->id }}">
                                Complete
                            </button>
                            <a href="{{ route('transactions.edit', $transaction->id) }}">
                                <button class="btn btn-warning">Edit</button>
                            </a>
                            <form action="{{ route('transactions.cancel', $transaction->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        @endif
                        @if ($transaction->status === 'completed')
                            not available.
                        @endif
                        @if ($transaction->status === 'cancelled')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $transaction->id }}">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal for Delete -->
                <div class="modal fade" id="deleteModal{{ $transaction->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Payment -->
                <div class="modal fade" id="payment{{ $transaction->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Complete Transaction</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div>Name: {{ $transaction->customer->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div>Service: {{ $transaction->service->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div>Amount: {{ $transaction->total_amount }}</div>
                                    </div>
                                    <div class="row">
                                        <div>Total Price: {{ $transaction->total_amount * $transaction->service->price }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr class="my-4">
                                    </div>
                                    <form action="{{ route('payments.store') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="row">
                                            <div class="mb-3">
                                                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                                <input type="hidden" name="amount"
                                                    value="{{ $transaction->total_amount * $transaction->service->price }}">
                                                <label for="payment_method_id" class="form-label">Payment Method:</label>
                                                <select class="form-select" name="payment_method_id"
                                                    aria-label="Default select example">
                                                    @forelse ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}">
                                                            {{ $payment_method->name }}</option>
                                                    @empty
                                                        <option disabled>No payment method available.</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Complete Payment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="6">No data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
