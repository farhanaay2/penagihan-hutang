@extends('layouts.app')

@section('title', 'Tambah Debitur')

@section('content')
<div class="container py-5" style="max-width: 720px;">

    <h2 class="fw-bold text-center mb-4"> Form Tambah Debitur</h2>

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Debitur</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg" placeholder="Masukkan nama" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control form-control-lg" placeholder="0812xxxx" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="address" class="form-control form-control-lg" rows="2" placeholder="Contoh: Jl. Sukajadi No.10">{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan</label>
                    <textarea name="note" class="form-control form-control-lg" rows="2" placeholder="Catatan tambahan">{{ old('note') }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-lg">⬅ Kembali</a>
                    <button type="submit" class="btn btn-success btn-lg">💾 Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
