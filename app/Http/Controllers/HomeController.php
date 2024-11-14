<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all(); // Fetch all categories
        $products = Product::all();    // Fetch all products

        return view('home', compact('categories', 'products'));
    }

    public function showCategoryProducts($categoryId)
    {
        // Find the category by its ID
        $category = Category::findOrFail($categoryId);

        // Get products related to the category
        $products = $category->products;  // Assuming your Category model has a 'products' relationship

        return view('category.show', compact('category', 'products'));
    }

}
