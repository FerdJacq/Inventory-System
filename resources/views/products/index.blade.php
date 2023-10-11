@extends('home')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <h1>Product List</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td class="prod-descrip">{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
