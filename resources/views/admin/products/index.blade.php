@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Управление товарами</h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-success mb-3">Добавить товар</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }} руб.</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
