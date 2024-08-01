@extends('layouts.main')

@section('title', 'Data Customer')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3>Data Transaction</h3>
        <a href="{{ route('transactions.create') }}">
            <button class="btn btn-primary">Add</button>
        </a>
    </div>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Service</th>
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
                    <td>{{ $transaction->total_amount }}</td>
                    <td>
                        @if ($transaction->status === 'on proggres')
                            <span class="badge rounded-pill text-bg-warning">on progress</span>
                        @elseif ($transaction->status === 'completed')
                            <span class="badge rounded-pill text-bg-success">success</span>
                        @elseif ($transaction->status === 'cancelled')
                            <span class="badge rounded-pill text-bg-danger">cancelled</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('transactions.edit', $transaction->id) }}"><button
                                class="btn btn-warning">Edit</button></a>
                        @if ($transaction->status === 'cancelled')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $transaction->id }}">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal -->
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
