@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filtres -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Catégories</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 p-1">
                            <a href="{{ url('/products') }}" 
                               class="text-decoration-none {{ !$selectedCategory ? 'fw-bold text-primary' : 'text-dark' }}">
                               Toutes les catégories
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="list-group-item border-0 p-1">
                                <a href="{{ url('/products?category=' . $category->id . ($selectedSort ? '&sort=' . $selectedSort : '')) }}" 
                                   class="text-decoration-none {{ $selectedCategory == $category->id ? 'fw-bold text-primary' : 'text-dark' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Grille de Produits -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold mb-0">Nos Produits</h1>
                
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle px-4" type="button" data-bs-toggle="dropdown">
                        Trier par
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li>
                            <a class="dropdown-menu-item dropdown-item {{ $selectedSort == 'price_asc' ? 'active' : '' }}" 
                               href="{{ url('/products?sort=price_asc' . ($selectedCategory ? '&category=' . $selectedCategory : '')) }}">
                               Prix croissant
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-menu-item dropdown-item {{ $selectedSort == 'price_desc' ? 'active' : '' }}" 
                               href="{{ url('/products?sort=price_desc' . ($selectedCategory ? '&category=' . $selectedCategory : '')) }}">
                               Prix décroissant
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @if($articles->isEmpty())
                <div class="text-center py-5">
                    <h5 class="text-muted">Aucun produit trouvé dans cette catégorie.</h5>
                </div>
            @else
                <div class="row g-4">
                    @foreach($articles as $article)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                                <div class="position-relative overflow-hidden" style="height: 200px; background-color: #f8f9fa;">
                                    <img src="{{ asset('articlepic/' . $article->article_image) }}" 
                                         class="card-img-top w-100 h-100 p-3" 
                                         alt="{{ $article->article_name }}"
                                         style="object-fit: contain;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase tracking-wider fw-bold" style="font-size: 0.7rem;">
                                            {{ $article->category->name ?? 'Sans catégorie' }}
                                        </small>
                                    </div>
                                    <h5 class="card-title fw-bold mb-2 h6">{{ $article->article_name }}</h5>
                                    <p class="card-text text-muted small mb-3 flex-grow-1">
                                        {{ Str::limit($article->description, 80) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                                        <span class="h6 fw-bold mb-0 text-primary">{{ number_format($article->price, 2) }} €</span>
                                        <form action="{{ route('cart.add', $article->article_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-dark px-3 rounded-pill">
                                                Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.transition {
    transition: all 0.3s ease;
}
.tracking-wider {
    letter-spacing: 0.05em;
}
</style>
@endsection