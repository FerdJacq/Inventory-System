<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StocksController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('stocks.index', compact('products'));
    }

}
