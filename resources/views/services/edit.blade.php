@extends('layouts.main')

@section('title', 'Add Customer')

@section('content')
    <div class="px-5">
        <h3>Edit Service</h3>
        <form action="{{ route('services.update', $service->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $service->name) }}">
                @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price :</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $service->price) }}">
                @error('price')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit Service</button>
            <a href="{{ route('services.index') }}"><button type="button" class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
