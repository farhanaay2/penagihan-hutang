@extends('layouts.app')

@section('title', 'Pembayaran Hutang')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">
         Pembayaran Hutang: {{ $customer->name }}
    </h2>

    <form action="{{ route('payments.store', ['customer' => $customer->id, 'debt' => $debt->id]) }}" method="POST">
        @csrf

        <label>Nominal Bayar (Rp):</label>
        <input type="number" name="amount" class="form-control" required>
        <br>

        <label>Tanggal Bayar:</label>
        <input type="date" name="date" class="form-control" required>
        <br>

        <label>Catatan:</label>
        <textarea name="note" class="form-control"></textarea>
        <br>

        <button class="btn btn-success">Simpan Pembayaran</button>
        <a href="{{ route('debts.index', $customer->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
