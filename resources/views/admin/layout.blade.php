@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse h-100 min-vh-100">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">
                            Tableau de Bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.products.index') }}">
                            Produits
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.orders.index') }}">
                            Commandes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.coupons.index') }}">
                            Coupons
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>
</div>
@endsection
