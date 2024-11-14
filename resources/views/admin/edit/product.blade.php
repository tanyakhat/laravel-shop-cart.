@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать товар</h1>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Количество</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
