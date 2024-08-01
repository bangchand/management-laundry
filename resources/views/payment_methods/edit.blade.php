@extends('layouts.main')

@section('title', 'Add Customer')

@section('content')
    <div class="px-5">
        <h3>Edit Payment Method</h3>
        <form action="{{ route('payment_methods.update', $payment_method->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', $payment_method->name) == '' ? $payment_method->name : old('name', $payment_method->name) }}">
                @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status[1]" value="available" id="status1"
                        {{ old('status.1', $payment_method->status) === 'available' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status1">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status[1]" value="unavailable" id="status2"
                        {{ old('status.1', $payment_method->status) === 'unavailable' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status2">
                        Unavailable
                    </label>
                </div>
                @error('status')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control">{{ old('description', $payment_method->description) == '' ? $payment_method->description : old('description', $payment_method->description) }}</textarea>
                @error('description')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('payment_methods.index') }}"><button type="button"
                    class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
