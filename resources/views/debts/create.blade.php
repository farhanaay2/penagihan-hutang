@extends('layouts.app')

@section('title', 'Tambah Hutang')

@section('content')
<div class="container mt-4" style="max-width: 700px;">
    <h2 class="fw-bold mb-4">Tambah Limit Pinjaman</h2>

    <form action="{{ route('debts.store', $customer->id) }}" method="POST" class="border rounded p-4 shadow-sm bg-white">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Nominal (Rp)</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <select name="status" class="form-control" required>
                <option value="belum lunas">Belum Lunas</option>
                <option value="lunas">Lunas</option>
            </select>
        </div>

       <div class="mb-3">
         <label class="form-label fw-bold">Status Verifikasi</label>
         <select name="status_verifikasi" id="status_verifikasi" class="form-control" required>
            <option value="approved">Terverifikasi</option>
            <option value="pending">Belum Terverifikasi</option>
            <option value="rejected">Ditolak</option>
        </select>
        </div>


        <div class="mb-3">
            <label class="form-label fw-bold">Catatan</label>
            <textarea name="note" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection

<script>
document.getElementById('status_verifikasi').addEventListener('change', function() {
    let status = this.value;
    let amountInput = document.getElementById('amount');

    if (status === 'rejected') {
        amountInput.value = 0;
        amountInput.readOnly = true; // Kunci input
    } else {
        amountInput.readOnly = false;
        amountInput.value = ""; // Kosongkan kalau bukan reject
    }
});
</script>

