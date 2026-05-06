@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tableau de Bord</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Produits</h5>
                <p class="card-text display-4">{{ $productsCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Commandes</h5>
                <p class="card-text display-4">{{ $ordersCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Utilisateurs</h5>
                <p class="card-text display-4">{{ $usersCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info h-100">
            <div class="card-body">
                <h5 class="card-title">Coupons</h5>
                <p class="card-text display-4">{{ $couponsCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
