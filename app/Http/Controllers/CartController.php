<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->quantity > 0) {
            $cartItem = CartItem::where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->quantity += 1;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $productId;
                $cartItem->quantity = 1;
            }
            $cartItem->save();

            $product->quantity -= 1;
            $product->save();

            return redirect()->back()->with('success', 'Товар добавлен в корзину');

        } else {
            return redirect()->back()->with('error', 'Товар закончился');
        }
    }

    public function update(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        if ($request->action == 'increase') {
            $cartItem->quantity += 1;  // Увеличиваем количество
        }

        if ($request->action == 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;  // Уменьшаем количество, если оно больше 1
        }

        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Корзина обновлена.');
    }

    public function remove($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
    }

    public function checkout()
    {
        // Получаем все товары в корзине
        $cartItems = CartItem::all();  // Если корзина не связана с пользователем, используйте CartItem::all()

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }

        // Создаем заказ
        $order = Order::create([
            'total_price' => $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
        ]);

        // Перемещаем товары в заказ
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,  // Связь с заказом
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Очищаем корзину
        CartItem::truncate();

        // Если это AJAX-запрос, возвращаем только навигацию
        if (request()->ajax()) {
            return response()->json([
                'message' => 'Покупка успешно завершена!',
                'view' => view('partials.navigation')->render(),  // Рендерим только навигацию
            ]);
        }

        // Для обычного запроса возвращаем redirect
        return redirect()->route('cart.index')->with('success', 'Покупка успешно завершена!');
    }
}
