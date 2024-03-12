<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function singleProduct($productId)
    {

        $product = Product::find($productId);

    if (!$product) {
        // Handle case where product with $productId was not found
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Return the product as a JSON response
    return response()->json($product);

    }

    public function offersProduct($productId)
    {

        $products = Product::findOrFail($productId);
        $offers = Offer::where('product_id', $productId)->get();

    
        return response()->json($offers);
    }
}

