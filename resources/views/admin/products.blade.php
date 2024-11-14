@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список товаров</h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-success my-2">Добавить товар</a>
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Цена:</strong> {{ $product->price }} руб.</p>
                            <p class="card-text"><strong>Количество:</strong> {{ $product->quantity }}</p>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
