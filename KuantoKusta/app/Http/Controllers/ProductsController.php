<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'

        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');

        if ($request->file()) {
            $file_name = time() . '_' . $request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');
            $product->image = '/storage/' . $file_name;
            $product->save();
        }


        return response()->json(['message' => 'Product created successfully']);
    }

    
}
