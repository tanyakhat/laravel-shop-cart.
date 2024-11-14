<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showProducts()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.create.product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Товар успешно добавлен.');
    }
    public function editProduct($id)
    {
        // Находим товар по его ID
        $product = Product::findOrFail($id);

        // Получаем все категории для выпадающего списка
        $categories = Category::all();

        // Возвращаем представление с товаром и категориями
        return view('admin.edit.product', compact('product', 'categories'));
    }
    public function updateProduct(Request $request, $id)
    {
        // Валидация входящих данных
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Находим товар по ID
        $product = Product::findOrFail($id);

        // Обновляем данные товара
        $product->update($request->all());

        // Перенаправляем назад в список товаров с сообщением об успехе
        return redirect()->route('admin.products')->with('success', 'Товар успешно обновлен.');
    }
}
