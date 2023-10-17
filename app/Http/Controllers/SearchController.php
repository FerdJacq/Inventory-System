<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function getSuggestions(Request $request)
{
    $query = $request->input('query');
    $suggestions = Product::where('name', 'like', "%$query%")->pluck('name');
    return response()->json($suggestions);
}
}
