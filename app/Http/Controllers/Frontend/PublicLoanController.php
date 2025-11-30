<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Opa;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicLoanController extends Controller
{
    // public function create()
    // {
    //     return view('frontend.loans.create');
    // }

    public function pinjamanForm()
    {
        $cart = session('cart', []);

        return view('frontend.loans.create', [
            'cartItems' => $cart
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organization_name' => 'required|string|max:255',
            'campus_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'notes' => 'required|string|max:500',
            'loan_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'organization_name.required' => 'Nama organisasi wajib diisi.',
            'campus_name.required' => 'Nama kampus wajib diisi.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'borrow_date.required' => 'Tanggal pinjam wajib diisi.',
            'return_date.required' => 'Tanggal kembali wajib diisi.',
            'return_date.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal pinjam.',
            'notes.required' => 'Keperluan peminjaman wajib diisi.', // Ini akan muncul sekarang
            'loan_document.mimes' => 'File dokumen harus berupa PDF atau DOC/DOCX.',
            'loan_document.max' => 'File dokumen maksimal 2MB.',
        ]);

        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $opa = Opa::create([
            'name' => $request->name,
            'organization_name' => $request->organization_name,
            'campus_name' => $request->campus_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        $loan = Loan::create([
            'opa_id' => $opa->id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'requested',
            'notes' => $request->notes, // <--- DISINI
            'loan_document' => $request->hasFile('loan_document')
                ? $request->file('loan_document')->store('loan_documents')
                : null,
        ]);

        foreach ($cartItems as $item) {
            LoanDetail::create([
                'loan_id' => $loan->id,
                'item_id' => $item['id'],
                'quantity' => $item['qty'] ?? 1,
            ]);
        }

        session()->forget('cart');

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim!');
    }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'organization_name' => 'required|string|max:255',
    //         'campus_name' => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:20',
    //         'email' => 'required|email|max:255',
    //         'user_id' => 'nullable|integer|exists:users,id',
    //         'opa_id' => 'nullable|integer',
    //         'borrow_date' => 'required|date',
    //         'return_date' => 'required|date|after_or_equal:borrow_date',
    //         'status' => 'nullable|string|in:pending,approved,rejected',
    //         'notes' => 'nullable|string|max:500',
    //         'loan_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    //         'cart_items' => 'required|string',
    //     ], [
    //         'name.required' => 'Nama lengkap wajib diisi.',
    //         'organization_name.required' => 'Nama organisasi wajib diisi.',
    //         'campus_name.required' => 'Nama kampus wajib diisi.',
    //         'phone_number.required' => 'Nomor telepon wajib diisi.',
    //         'email.required' => 'Email wajib diisi.',
    //         'borrow_date.required' => 'Tanggal pinjam wajib diisi.',
    //         'return_date.required' => 'Tanggal kembali wajib diisi.',
    //         'return_date.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal pinjam.',
    //         'loan_document.mimes' => 'File dokumen harus berupa PDF atau DOC/DOCX.',
    //         'loan_document.max' => 'File dokumen maksimal 2MB.',
    //         'cart_items.required' => 'Keranjang masih kosong!',
    //     ]);

    //     // === 1. Simpan ke table OPA ===
    //     $opa = Opa::create([
    //         'name' => $request->name,
    //         'organization_name' => $request->organization_name,
    //         'campus_name' => $request->campus_name,
    //         'phone_number' => $request->phone_number,
    //         'email' => $request->email,
    //     ]);

    //     // === 2. Simpan ke table LOAN ===
    //     $loan = Loan::create([
    //         'opa_id' => $opa->id,
    //         'borrow_date' => $request->borrow_date,
    //         'return_date' => $request->return_date,
    //         'status' => 'requested',
    //         'notes' => $request->notes,
    //         'loan_document' => $request->hasFile('loan_document') ? $request->file('loan_document')->store('loan_documents') : null,
    //     ]);

    //     // === 3. Simpan detail barang ===
    //     $cartItems = json_decode($request->cart_items, true);
    //     foreach ($cartItems as $item) {
    //         LoanDetail::create([
    //             'loan_id' => $loan->id,
    //             'item_id' => $item['id'],
    //             'quantity' => $item['qty'] ?? 1,
    //         ]);
    //     }

    //     return redirect()->back()
    //         ->with('success', 'Pengajuan berhasil dikirim!');
    // }
}
