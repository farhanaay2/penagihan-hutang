@extends('layouts.app')

@section('title', 'Detail Debitur')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Detail Debitur</h2>

    <div class="mb-3">
        <p><strong>Nama:</strong> {{ $customer->name }}</p>
        <p><strong>No. HP:</strong> {{ $customer->phone }}</p>
        <p><strong>Alamat:</strong> {{ $customer->address }}</p>
        <p><strong>Catatan:</strong> {{ $customer->note }}</p>
    </div>

    {{-- Total Hutang + Status --}}
    <div class="alert alert-info mt-3">
        <strong>Total Hutang Saat Ini: </strong>
        <span class="text-primary fw-bold">
            Rp {{ number_format($sisaHutang, 0, ',', '.') }}
        </span>
    </div>

    @if($sisaHutang <= 0)
        <div class="badge bg-success" style="font-size:16px;">Lunas</div>
    @else
        <div class="badge bg-danger" style="font-size:16px;">Belum Lunas</div>
    @endif

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Daftar Hutang</h4>
        <a href="{{ route('debts.create', $customer->id) }}" class="btn btn-success btn-sm">
            Tambah Hutang
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
        @forelse($customer->debts as $debt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Rp {{ number_format($debt->amount, 0, ',', '.') }}</td>
                <td>{{ $debt->date }}</td>
                <td>{{ $debt->status }}</td>
                <td>{{ $debt->note }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada hutang 
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
@endsection
