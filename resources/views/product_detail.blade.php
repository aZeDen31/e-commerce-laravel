@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-dark">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none text-dark">Produits</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $article->article_name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Image Produit -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm overflow-hidden" style="background-color: #f8f9fa;">
                @if($article->article_image)
                    <img src="{{ asset('articlepic/' . $article->article_image) }}" 
                         class="img-fluid w-100 p-4" 
                         alt="{{ $article->article_name }}"
                         style="object-fit: contain; max-height: 500px;">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height: 400px;">
                        <span class="text-muted">Aucune image disponible</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Détails Produit -->
        <div class="col-md-6">
            <div class="mb-2">
                <span class="badge bg-secondary text-uppercase tracking-wider fw-bold">
                    {{ $article->category->name ?? 'Sans catégorie' }}
                </span>
            </div>
            
            <h1 class="display-5 fw-bold mb-3">{{ $article->article_name }}</h1>
            
            <p class="h3 fw-bold text-primary mb-4">{{ number_format($article->price, 2) }} €</p>
            
            <div class="mb-4">
                <h5 class="fw-bold mb-2">Description</h5>
                <p class="text-muted" style="line-height: 1.8;">
                    {{ $article->description }}
                </p>
            </div>

            <hr class="my-4">

            <form action="{{ route('cart.add', $article->article_id) }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label fw-bold">Quantité :</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" value="1" min="1" max="99" style="width: 80px;">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-dark px-4 py-2 rounded-pill fw-bold">
                            🛒 Ajouter au panier
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.tracking-wider {
    letter-spacing: 0.05em;
}
</style>
@endsection
