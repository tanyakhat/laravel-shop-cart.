@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ваша корзина</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($cartItems))
            <p>Ваша корзина пуста.</p>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Итого</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->price }} руб.</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-secondary" name="action" value="increase">+</button>
                                    <span>{{ $item->quantity }}</span>
                                    <button type="submit" class="btn btn-sm btn-secondary" name="action" value="decrease">-</button>
                                </form>
                            </td>
                            <td>{{ $item->quantity * $item->product->price }} руб.</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h4>Общая стоимость: {{ $totalPrice }} руб.</h4>

                <form id="checkout-form">
                    @csrf
                    <button type="submit" class="btn btn-success">Купить</button>
                </form>
            </div>
        @endif
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Обработка формы через AJAX
        $('#checkout-form').submit(function(event) {
            event.preventDefault();  // Отменяем стандартное отправление формы

            $.ajax({
                url: '{{ route("cart.checkout") }}',  // Указываем маршрут для обработки заказа
                type: 'POST',
                data: $(this).serialize(),  // Данные формы (включая csrf токен)
                success: function(response) {
                    // После успешной обработки заказа, скрыть корзину и оставить только навигацию
                    $('body').html(response.view);  // Заменяем весь body на новый ответ, который содержит только навигацию
                    alert(response.message);  // Показать сообщение о завершении покупки
                },
                error: function() {
                    alert('Произошла ошибка. Попробуйте снова.');
                }
            });
        });
    });
</script>

