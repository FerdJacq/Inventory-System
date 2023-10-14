@extends('home') {{-- Assuming you have a main layout file --}}

@section('content')
    <h1>Order History</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
