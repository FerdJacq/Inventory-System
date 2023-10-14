<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $quantity = $request->input('quantity');
        $totalPrice = $product->price * $quantity;

        $order = new Order([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);

        $order->save();

        $product->quantity -= $quantity;
        $product->save();

        return redirect()->route('order.history')->with('success', 'Order placed successfully.');
    }

    public function orderHistory()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('orders.history', compact('orders'));
    }

    public function showOrderForm()
    {
        $products = Product::all();
        return view('orders.form', compact('products'));
    }

    public function placeOrder(Request $request)
    {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->input('product_id'));

    if ($product->quantity < $request->input('quantity')) {
        return redirect()->route('order.form')->with('error', 'Insufficient stock for this product');
    }

    $totalPrice = $product->price * $request->input('quantity');

    $order = new Order([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => $request->input('quantity'),
        'total_price' => $totalPrice,
    ]);

    $order->save();

    $product->decrement('quantity', $request->input('quantity'));

        return redirect()->route('order.success')->with('success', 'Order placed successfully');
    }
}
