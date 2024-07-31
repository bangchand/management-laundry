@extends('layouts.main')

@section('title', 'Add Customer')

@section('content')
    <div class="px-5">
        <h3>Create Customer</h3>
        <form action="{{ route('customers.store') }}" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone :</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address :</label>
                <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                @error('address')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
            <a href="{{ route('customers.index') }}"><button type="button" class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
