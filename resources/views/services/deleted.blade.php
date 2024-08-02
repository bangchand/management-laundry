@extends('layouts.main')

@section('title', 'Deleted Service')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h3>Deleted Service</h3>
    </div>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ Str::limit($service->description, 35) ? $customer->description : '-' }}</td>
                    <td>{{ number_format($service->price, 0) }}</td>
                    <td class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#restoreModal{{ $service->id }}">
                            Restore
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $service->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="restoreModal{{ $service->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to restore this?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('services.restore', $service->id) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1"
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
                                <form action="{{ route('services.delete', $service->id) }}" method="post">
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
