@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Mon Panier</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <div class="mb-4">
                <span class="display-1">🛒</span>
            </div>
            <h4 class="text-muted mb-4">Votre panier est vide.</h4>
            <a href="{{ url('/products') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">Découvrir nos produits</a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4 py-3">Produit</th>
                                        <th scope="col" class="py-3">Prix</th>
                                        <th scope="col" class="py-3" style="width: 150px;">Quantité</th>
                                        <th scope="col" class="py-3">Total</th>
                                        <th scope="col" class="pe-4 py-3 text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        @if($item->article)
                                            <tr>
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('articlepic/' . $item->article->article_image) }}" alt="{{ $item->article->article_name }}" class="rounded me-3 shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">{{ $item->article->article_name }}</h6>
                                                            <small class="text-muted">{{ $item->article->category->name ?? '' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->article->price, 2) }} €</td>
                                                <td>
                                                    <form action="{{ route('cart.update', $item->cart_id) }}" method="POST" class="d-flex align-items-center">
                                                        @csrf
                                                        <input type="number" name="quantity" value="{{ $item->article_number }}" min="1" class="form-control form-control-sm me-2 text-center" style="width: 60px;">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="Mettre à jour">
                                                            ↻
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="fw-bold">{{ number_format($item->article->price * $item->article_number, 2) }} €</td>
                                                <td class="pe-4 text-end">
                                                    <form action="{{ route('cart.remove', $item->cart_id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                            🗑
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 2rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Résumé de la commande</h5>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Sous-total</span>
                            <span class="fw-medium">{{ number_format($total, 2) }} €</span>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-primary">{{ number_format($total, 2) }} €</span>
                        </div>
                        
                        <button class="btn btn-primary w-100 btn-lg rounded-pill shadow-sm">Passer à la caisse</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
