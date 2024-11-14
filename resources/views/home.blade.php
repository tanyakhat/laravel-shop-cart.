@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добро пожаловать в Онлайн-Магазин Татьяна</h1>
        <p>В нашем магазине огромное количество товаров, даже по очень хорошей цене!</p>

        <!-- Category List -->

        <div class="row mb-4">
            <h2>Категории:</h2>
            @foreach($categories as $category)
                <div class="col-md-4">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="{{ route('category.products', $category->id) }}" class="btn btn-primary">Просмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <h2>Все товары:</h2>
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
