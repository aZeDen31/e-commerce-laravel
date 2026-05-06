@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        
        <!-- Colonne Gauche : Infos Utilisateur et Solde -->
        <div class="col-lg-4">
            <!-- Carte Utilisateur -->
            <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">
                <div class="bg-primary text-white p-4 text-center">
                    <img src="{{ asset('profilepic/' . $user->profile_picture) }}" 
                         alt="Photo de profil" 
                         class="rounded-circle border border-4 border-white shadow mb-3" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <p class="mb-0 opacity-75">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Carte Solde -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Mon Solde</h5>
                        <div class="badge bg-success bg-opacity-10 text-success p-2 rounded-pill fs-5">
                            {{ number_format($user->solde, 2) }} €
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.balance') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label text-muted small fw-bold">Recharger mon compte (en €)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">💶</span>
                                <input type="number" class="form-control border-start-0 ps-0" id="amount" name="amount" min="1" step="1" placeholder="Montant à ajouter" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                            Ajouter les fonds
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Colonne Droite : Historique des commandes -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h4 class="fw-bold mb-0">Historique de commandes</h4>
                </div>
                <div class="card-body p-4">
                    
                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <div class="display-1 text-muted opacity-25 mb-3">📦</div>
                            <h5 class="fw-bold text-muted mb-3">Vous n'avez pas encore passé de commande.</h5>
                            <a href="{{ url('/products') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                Découvrir nos produits
                            </a>
                        </div>
                    @else
                        <div class="accordion" id="ordersAccordion">
                            @foreach($orders as $order)
                                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                                        <button class="accordion-button collapsed bg-light text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                            <div class="d-flex justify-content-between w-100 pe-3">
                                                <span>Commande #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                <span class="text-primary">{{ number_format($order->total, 2) }} €</span>
                                                <span>
                                                    @if($order->status == 'en attente')
                                                        <span class="badge bg-warning text-dark">En attente</span>
                                                    @else
                                                        <span class="badge bg-success">Traitée</span>
                                                    @endif
                                                </span>
                                                <span class="text-muted small fw-normal">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}" data-bs-parent="#ordersAccordion">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="text-muted small text-uppercase">
                                                        <tr>
                                                            <th>Article</th>
                                                            <th class="text-center">Quantité</th>
                                                            <th class="text-end">Prix Unitaire</th>
                                                            <th class="text-end">Sous-total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->items as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        @if($item->article)
                                                                            <img src="{{ asset('articlepic/' . $item->article->article_image) }}" alt="{{ $item->article->article_name }}" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                                            <span class="fw-medium">{{ $item->article->article_name }}</span>
                                                                        @else
                                                                            <span class="text-muted fst-italic">Article introuvable</span>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{ $item->quantity }}</td>
                                                                <td class="text-end">{{ number_format($item->price, 2) }} €</td>
                                                                <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity, 2) }} €</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
        
    </div>
</div>

<style>
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #212529;
    box-shadow: none;
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
}
</style>
@endsection
