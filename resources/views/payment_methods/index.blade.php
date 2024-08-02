@extends('layouts.main')

@section('title', 'Data Payment Method')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3>Data Payment Method</h3>
        <a href="{{ route('payment_methods.create') }}">
            <button class="btn btn-primary">Add</button>
        </a>
    </div>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payment_methods as $payment_method)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $payment_method->name }}</td>
                    <td>{{ Str::limit($payment_method->description, 35) ? $customer->description : '-' }}</td>
                    <td>{{ $payment_method->status }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('payment_methods.edit', $payment_method->id) }}"><button
                                class="btn btn-warning">Edit</button></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $payment_method->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $payment_method->id }}" tabindex="-1"
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
                                <form action="{{ route('payment_methods.destroy', $payment_method->id) }}" method="post">
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
