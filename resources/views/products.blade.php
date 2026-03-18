@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nos Produits</h1>
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $article->article_image) }}" class="card-img-top" alt="{{ $article->article_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->article_name }}</h5>
                        <p class="card-text">{{ $article->description }}</p>
                        <p class="fw-bold">{{ $article->price }} €</p>
                        <a href="#" class="btn btn-primary">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection