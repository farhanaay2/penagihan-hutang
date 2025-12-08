@extends('layouts.app')

@section('title', 'Edit Hutang')

@section('content')
<div class="container mt-4" style="max-width: 700px;">

    <h2 class="fw-bold mb-4">Edit Hutang untuk: {{ $customer->name }}</h2>

    <form action="{{ route('debts.update', [$customer->id, $debt->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nominal (Rp):</label>
        <input type="number" name="date" value="{{ $debt->amount }}" class="form-control" required>
        <br>

        <label>Tanggal:</label>
        <input type="date" name="date" value="{{ $debt->date }}" class="form-control" required>
        <br>

        <label>Status:</label>
        <select name="status" class="form-control" required>
            <option value="belum lunas" {{ $debt->status == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
            <option value="lunas" {{ $debt->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        <br>

        <label>Catatan:</label>
        <textarea name="note" class="form-control">{{ $debt->note }}</textarea>
        <br>

        <button class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('debts.index', $customer->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
