@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">Dashboard Admin</h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Debitur</h5>
                <h3 class="fw-bold text-primary">{{ $totalCustomers }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Hutang Masuk</h5>
                <h3 class="fw-bold text-danger">Rp {{ number_format($totalDebts) }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Total Pembayaran</h5>
                <h3 class="fw-bold text-success">Rp {{ number_format($totalPayments) }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h5>Sisa Hutang</h5>
                <h3 class="fw-bold text-warning">Rp {{ number_format($totalRemaining) }}</h3>
            </div>
        </div>

    </div>

    <hr>

</div>
@endsection
