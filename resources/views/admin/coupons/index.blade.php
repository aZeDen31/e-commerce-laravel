@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Coupons de réduction</h1>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Ajouter un coupon</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Type</th>
                <th>Valeur</th>
                <th>Valable jusqu'au</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td><span class="badge bg-secondary">{{ $coupon->code }}</span></td>
                <td>{{ $coupon->type == 'percent' ? 'Pourcentage (%)' : 'Montant Fixe (€)' }}</td>
                <td>
                    {{ $coupon->value }} {{ $coupon->type == 'percent' ? '%' : '€' }}
                </td>
                <td>
                    @if($coupon->valid_until)
                        {{ \Carbon\Carbon::parse($coupon->valid_until)->format('d/m/Y') }}
                    @else
                        Illimité
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
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
