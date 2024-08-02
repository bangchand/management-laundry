@extends('layouts.main')

@section('title', 'Data Customer')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3>Data Customer</h3>
        <a href="{{ route('customers.create') }}">
            <button class="btn btn-primary">Add</button>
        </a>
    </div>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email ? $customer->email : '-' }}</td>
                    <td>{{ Str::limit($customer->address, 35) ? $customer->address : '-' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('customers.edit', $customer->id) }}"><button
                                class="btn btn-warning">Edit</button></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $customer->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $customer->id }}" tabindex="-1"
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
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
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
            @endforelse
        </tbody>
    </table>
@endsection
