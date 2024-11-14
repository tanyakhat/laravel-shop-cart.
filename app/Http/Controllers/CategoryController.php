<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index');
    }
    public function showProducts($categoryId)
    {
        // Получаем категорию вместе с продуктами
        $category = Category::with('products')->findOrFail($categoryId);

        return view('categories.products', [
            'category' => $category,
            'products' => $category->products,
        ]);
    }
}
