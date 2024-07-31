@extends('layouts.main')

@section('title', 'Edit Customer')

@section('content')
    <div class="px-5">
        <h3>Edit Customer</h3>
        <form action="{{ route('customers.update', $customer->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', $service->name) == '' ? $service->name : old('name', $service->name) }}">
                @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone :</label>
                <input type="text" class="form-control" name="phone"
                    value="{{ old('phone', $service->phone) == '' ? $service->phone : old('phone', $service->phone) }}">
                @error('phone')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" name="email"
                    value="{{ old('email', $service->email) == '' ? $service->email : old('email', $service->email) }}">
                @error('email')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address :</label>
                <textarea name="address" class="form-control">{{ old('name', $service->name) == '' ? $service->name : old('name', $service->name) }}</textarea>
                @error('address')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('customers.index') }}"><button type="button" class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
