@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifier le Produit</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Retour</a>
</div>

<div class="row">
    <div class="col-md-8">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->article_id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="article_name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="article_name" name="article_name" value="{{ old('article_name', $product->article_name) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id') ?? $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix (€)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="article_image" class="form-label">URL de l'image</label>
                <input type="url" class="form-control" id="article_image" name="article_image" value="{{ old('article_image', $product->article_image) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
