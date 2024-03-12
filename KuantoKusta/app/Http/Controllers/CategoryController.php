<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function displayProducts($categoryId)
    {
        $category = Categorie::findOrFail($categoryId);
        $products = Product::where('category_id', $categoryId)->get();


        return response()->json([
            'products' => $products,
            'category' => $category->name, // Include the category name
        ]);
    }

    public function displayCategories()
    {
        $categories = Categorie::all();

        return response()->json($categories);
    }
}
