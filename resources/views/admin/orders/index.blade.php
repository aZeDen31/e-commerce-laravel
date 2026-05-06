@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Commandes</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user ? $order->user->name : 'Utilisateur supprimé' }}</td>
                <td>{{ number_format($order->total, 2) }} €</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($order->status == 'en attente')
                        <span class="badge bg-warning text-dark">En attente</span>
                    @else
                        <span class="badge bg-success">Traitée</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <select name="status" class="form-select form-select-sm me-2" style="width: auto;">
                            <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="traitée" {{ $order->status == 'traitée' ? 'selected' : '' }}>Traitée</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Appliquer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
