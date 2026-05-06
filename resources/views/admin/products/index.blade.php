@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Produits</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Ajouter un produit</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->article_id }}</td>
                <td>
                    @if($product->article_image)
                        <img src="{{ asset('articlepic/' . $product->article_image) }}" alt="{{ $product->article_name }}" width="50" class="img-thumbnail">
                    @else
                        <span class="text-muted">Aucune</span>
                    @endif
                </td>
                <td>{{ $product->article_name }}</td>
                <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                <td>{{ number_format($product->price, 2) }} €</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->article_id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                    <form action="{{ route('admin.products.destroy', $product->article_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
