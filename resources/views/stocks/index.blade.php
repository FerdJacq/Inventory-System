@extends('home')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="row"><h1>Product List</h1></div>
            <div class="row"><input id="myInput" type="text" placeholder="Search.."></div>
        </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td class="prod-descrip">{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

