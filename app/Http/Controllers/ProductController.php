<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $stockStatus = $request->input('stock_status');

        // Retrieve products based on the selected stock status
        $products = Product::when($stockStatus, function ($query) use ($stockStatus) {
            return $query->where('stock_status', $stockStatus);
        })->get();

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

        $product = Product::create($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $product->image_path = str_replace('public/', '', $imagePath);
        }

        $product->save();

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

        $product->update($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $product->image_path = str_replace('public/', '', $imagePath);
        }

        $product->save();

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }

    public function addStock(Request $request)
    {
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'product_id' => 'required|exists:products,id'
    ]);

    $product = Product::findOrFail($request->input('product_id'));
    $quantityToAdd = $request->input('quantity');

    $product->increment('quantity', $quantityToAdd);

    $product->save();

        return redirect()->route('products.index')->with('Stock added successfully');
    }

// ======================= VUE Controller ==========================

    public function productVue(){
        $productVue = Product::all();
        return response()->json(
            [
                'products' => $productVue,
                'message' => 'Products',
                'code' => 200
            ]
        );
    }

    public function productVue_Add(Request $request) {
        $productVue = new Product();
        $productVue->name =  $request->id;
        $productVue->name =  $request->name;
        $productVue->description =  $request->description;
        $productVue->quantity =  $request->quantity;
        $productVue->price =  $request->price;
        $productVue->image_path =  $request->image_path;
        $productVue->save();

        return response()->json([
            'message' => 'Product Created Successfully',
            'code' => 200
        ]);
    }

    public function productVue_Del($id){
        $productVue = Product::find($id);
        if($productVue){
            $productVue->delete();
            return response()->json([
                'message' => "Product has been deleted",
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'message' => "Product with the id:$id is not existing!",
            ]);
        }
    }

    public function productVue_Edit($id){
        $productVue = Product::find($id);
        if($productVue){
            $productVue->get();
            return response()->json($productVue);
        }
    }

    public function productVue_Update($id, Request $request){
        $productVue = Product::where('id',$id)->first();
        $productVue->id =  $request->id;
        $productVue->name =  $request->name;
        $productVue->description =  $request->description;
        $productVue->quantity =  $request->quantity;
        $productVue->price =  $request->price;
        $productVue->image_path =  $request->image_path;
        $productVue->save();

        return response()->json([
            'message' => 'Product Updated Successfully',
            'code' => 200
        ]);
    }
}

