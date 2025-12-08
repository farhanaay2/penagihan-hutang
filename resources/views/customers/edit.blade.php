@extends('layouts.app')

@section('title', 'Edit Debitur')

@section('content')
<div class="container mt-5" style="max-width: 700px;">

    <h2 class="fw-bold text-center mb-4">Edit Data Debitur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="border rounded p-4 shadow-sm bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Debitur</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $customer->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">No HP</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', $customer->phone) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Alamat</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address', $customer->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Catatan</label>
            <textarea name="note" class="form-control" rows="2">{{ old('note', $customer->note) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>
@endsection
