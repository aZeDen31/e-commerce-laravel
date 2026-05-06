@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Créer un Coupon</h1>
    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Retour</a>
</div>

<div class="row">
    <div class="col-md-6">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Code du coupon</label>
                <input type="text" class="form-control text-uppercase" id="code" name="code" value="{{ old('code') }}" required placeholder="Ex: PROMO10">
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type de réduction</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Pourcentage (%)</option>
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Montant Fixe (€)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Valeur de la réduction</label>
                <input type="number" step="0.01" class="form-control" id="value" name="value" value="{{ old('value') }}" required>
            </div>

            <div class="mb-3">
                <label for="valid_until" class="form-label">Valable jusqu'au (Optionnel)</label>
                <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ old('valid_until') }}">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
