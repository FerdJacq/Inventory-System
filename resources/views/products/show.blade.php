@extends('home')

@section('content')
    <h1>Product Details</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
                </div>
            </div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary mt-3">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Delete</button>
            </form>
        </div>
        <div class="col-md-6">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid" alt="Product Image">
            @endif
        </div>
    </div>
@endsection
