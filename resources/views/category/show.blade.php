@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Товары в категории: {{ $category->name }}</h1>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Цена: </strong>{{ $product->price }} руб.</p>
                            <p class="card-text">Количество: {{ $product->quantity }}</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
