@extends('layouts.main')

@section('title', 'Add Customer')

@section('content')
    <div class="px-5">
        <h3>Create Service</h3>
        <form action="{{ route('services.store') }}" method="post">
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
                <label for="price" class="form-label">Price :</label>
                <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Service</button>
            <a href="{{ route('services.index') }}"><button type="button" class="btn btn-secondary">back</button></a>
        </form>
    </div>
@endsection
