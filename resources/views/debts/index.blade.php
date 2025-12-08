{{-- resources/views/debts/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pinjaman Debitur')

@section('content')
<div class="container py-4" style="max-width:1200px;">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="background:#ffffffcc;backdrop-filter:blur(10px);">

        {{-- HEADER DETAIL DEBITUR --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="fw-bold">
                    Detail Hutang: {{ $customer->name }}
                </h2>
                <p class="mb-0"><strong>No. HP:</strong> {{ $customer->phone }}</p>
                <p class="mb-0"><strong>Alamat:</strong> {{ $customer->address }}</p>
                <p class="mb-0"><strong>Catatan Debitur:</strong> {{ $customer->note }}</p>
            </div>
            {{-- BUTTON TAMBAH HUTANG --}}
            <a href="{{ route('debts.create', $customer->id) }}"
               class="btn btn-success px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                Tambah Limit Pinjaman
            </a>
        </div>

        {{-- ALERT BERHASIL --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- TOTAL HUTANG --}}
        @php $total = $debts->sum('amount'); @endphp
        <div class="alert alert-info rounded-4 shadow-sm fs-5 fw-semibold">
             Total Hutang Saat Ini:
            <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        {{-- DAFTAR HUTANG --}}
        <h4 class="fw-bold mb-3">Daftar Hutang</h4>

        <table class="table table-hover table-bordered rounded-4 overflow-hidden shadow-sm">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>#</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($debts as $debt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Rp {{ number_format($debt->amount, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($debt->date)->format('d/m/Y') }}</td>
                    <td>
                        @if($debt->status === 'lunas')
                            <span class="badge bg-success px-3 py-2">Lunas</span>
                        @else
                            <span class="badge bg-warning text-dark px-3 py-2">Belum Lunas</span>
                        @endif
                    </td>
                    <td>{{ $debt->note }}</td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            @if($debt->status === 'belum lunas')
                                <a href="{{ route('payments.create', ['customer'=>$customer->id, 'debt'=>$debt->id]) }}"
                                   class="btn btn-outline-info rounded-pill px-3 py-1 d-flex align-items-center gap-2">
                                     Pembayaran
                                </a>
                            @endif

                            <a href="{{ route('debts.edit', ['customer'=>$customer->id, 'debt'=>$debt->id]) }}"
                               class="btn btn-outline-primary rounded-pill px-3 py-1 d-flex align-items-center gap-2">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('debts.destroy', ['customer'=>$customer->id, 'debt'=>$debt->id]) }}"
                                  onsubmit="return confirm('Yakin mau hapus hutang ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger rounded-pill px-3 py-1 d-flex align-items-center gap-2">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        Belum ada hutang 
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- RIWAYAT PEMBAYARAN --}}
        <h4 class="fw-bold mt-5"> Riwayat Pembayaran</h4>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Nominal Bayar</th>
                    <th style="width:160px;">Tanggal Bayar</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
            @php $index = 1; @endphp
            @foreach($debts as $debt)
                @foreach($debt->payments as $payment)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                        <td>{{ $payment->note }}</td>
                    </tr>
                @endforeach
            @endforeach

            @if($index === 1)
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Belum ada pembayaran 
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">
            Kembali ke Daftar Debitur
        </a>
    </div>
</div>
@endsection
