<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $product->image_path = str_replace('public/', '', $imagePath);
            $product->save();
        }

        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product->update($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $product->image_path = str_replace('public/', '', $imagePath);
            $product->save();
        }

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
