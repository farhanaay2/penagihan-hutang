<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    // LIST HUTANG utk satu debitur
    public function index(Customer $customer)
    {
        $debts = $customer->debts()
            ->with('payments')
            ->orderBy('date', 'desc')
            ->get();

        return view('debts.index', compact('customer', 'debts'));
    }

    // FORM TAMBAH HUTANG
    public function create(Customer $customer)
    {
        return view('debts.create', compact('customer'));
    }

    // SIMPAN HUTANG BARU
    public function store(Request $request, Customer $customer)
{
    $data = $request->validate([
        'amount'        => ['required', 'integer', 'min:0'], // min 0 untuk rejected
        'date'          => ['required', 'date'],
        'status'        => ['required', 'in:belum lunas,lunas'],
        'status_verif'  => ['required', 'in:approved,rejected,pending'],
        'note'          => ['nullable', 'string'],
    ]);

    // Jika ditolak → amount wajib 0
    if ($request->status_verif === 'rejected') {
        $data['amount'] = 0;
    }

    $data['customer_id'] = $customer->id;

    // SIMPAN HUTANG (limit pinjaman)
    Debt::create($data);

    // UPDATE customer langsung
    $customer->update([
        'status_verifikasi' => $request->status_verif,
        'limit_pinjaman'    => $data['amount'],
        'alasan_penolakan'  => $request->status_verif === 'rejected'
                                ? ($request->note ?? 'Pengajuan ditolak')
                                : null
    ]);

    return redirect()
        ->route('debts.index', $customer->id)
        ->with('success', 'Limit pinjaman & status verifikasi berhasil diperbarui!');
}

    public function edit(Customer $customer, Debt $debt)
    {
        return view('debts.edit', compact('customer', 'debt'));
    }

    // UPDATE DATA HUTANG
    public function update(Request $request, Customer $customer, Debt $debt)
    {
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
            'date'   => ['required', 'date'],
            'status' => ['required', 'in:belum lunas,lunas'],
            'note'   => ['nullable', 'string'],
        ]);

        $debt->update($validated);

        return redirect()
            ->route('debts.index', $customer->id)
            ->with('success', 'Hutang berhasil diperbarui!');
    }

    // HAPUS HUTANG
    public function destroy(Customer $customer, Debt $debt)
    {
        $debt->delete();

        return redirect()
            ->route('debts.index', $customer->id)
            ->with('success', 'Hutang berhasil dihapus!');
    }
}
