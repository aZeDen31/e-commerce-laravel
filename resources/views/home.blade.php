@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner shadow-lg">
            <div class="carousel-item active" style="height: 500px;">
                <img src="{{ asset('img/tech_banner.png') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Tech Deals">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px; padding: 20px;">
                    <h2 class="display-4 fw-bold">Innovation à Votre Portée</h2>
                    <p class="lead">Découvrez les derniers produits tech au meilleur prix sur SwiftShop.</p>
                    <a href="/products" class="btn btn-primary btn-lg px-4">Acheter Maintenant</a>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img src="{{ asset('img/fashion_banner.png') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Fashion Selection">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px; padding: 20px;">
                    <h2 class="display-4 fw-bold">Style & Élégance</h2>
                    <p class="lead">Exprimez votre personnalité avec notre nouvelle collection de mode.</p>
                    <a href="/products" class="btn btn-warning btn-lg px-4 text-dark font-weight-bold">Explorer la Mode</a>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img src="{{ asset('img/home_banner.png') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Home Decor">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px; padding: 20px;">
                    <h2 class="display-4 fw-bold">Votre Maison, Votre Univers</h2>
                    <p class="lead">Transformez votre intérieur avec des pièces uniques et modernes.</p>
                    <a href="/products" class="btn btn-success btn-lg px-4">Décorer Ma Maison</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Presentation Section -->
    <div class="container my-5 py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-4">Bienvenue sur SwiftShop</h1>
                <p class="lead text-muted mb-4">
                    SwiftShop est votre destination ultime pour une expérience de shopping en ligne rapide, fiable et moderne. 
                    De la tech de pointe à la mode tendance, nous sélectionnons les meilleurs produits pour vous.
                </p>
                <i class="bi bi-stars text-warning fs-1"></i>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Parcourir par Catégories</h2>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="/products?category={{ $category->id }}" class="text-decoration-none text-dark card h-100 border-0 shadow-sm category-card" style="transition: transform 0.3s;">
                            <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                                <div class="bg-white rounded-circle shadow-sm p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                    <span class="fs-2 text-primary">📦</span>
                                </div>
                                <h6 class="fw-bold m-0">{{ $category->name }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.category-card:hover {
    transform: translateY(-10px);
    background-color: #fff !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.btn-primary {
    background: #0d6efd;
    border: none;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
}
.btn-primary:hover {
    background: #0b5ed7;
    transform: scale(1.05);
}
</style>
@endsection
