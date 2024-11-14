<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Показать все категории
    public function showCategories()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }



}

