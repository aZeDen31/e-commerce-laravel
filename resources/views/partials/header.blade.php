<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">{{ config('app.name', 'SwiftShop') }}</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/products">Produits</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item me-3">
                        <span class="badge bg-success">Solde : {{ Auth::user()->solde }} €</span>
                    </li>
                    <li class="nav-item me-3">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative d-flex align-items-center">
                            🛒 Panier
                            @php
                                $cartCount = \App\Models\Cart::where('autor_id', Auth::id())->sum('article_number');
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('profilepic/' . Auth::user()->profile_picture) }}" 
                                 alt="Profil" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">Mon Profil</a></li>
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item text-danger" href="/admin">Panel Admin</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="/register">S'inscrire</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>