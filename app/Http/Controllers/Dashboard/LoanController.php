<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Opa;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use App\Models\Category;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreLoanRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateLoanRequest;
use App\Mail\LoanApprovedMail;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $opas = Opa::all();
        $users = User::whereNot('role', 'admin')->get();

        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');
        $status = $request->get('status');

        $query = Loan::orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('full_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('opa', function ($o) use ($search) {
                        $o->where('name', 'like', "%{$search}%");
                    });
            });
        }


        if ($status && $status !== 'all') $query->where('status', $status);

        $loans = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            return view('dashboard.loans.partials.table', compact('loans'))->render();
        }

        return view('dashboard.loans.index', compact('loans', 'opas', 'users'));
    }

    public function accept($loan)
    {
        // dd($loan);
        $loan = Loan::findOrFail($loan);

        $loan->update(['status' => 'approved']);

        // Siapkan data untuk email
        $data = [
            'name' => $loan->opa->name,
            'id' => $loan->id,
            'email' => optional($loan->user)->email
                ?? optional($loan->opa)->email,

            'name' => optional($loan->user)->full_name
                ?? optional($loan->opa)->name,

            'organization_name' => optional($loan->opa)->organization_name,
            'campus_name' => optional($loan->opa)->campus_name,
            'phone_number' => optional($loan->user)->phone_number ?? optional($loan->opa)->phone_number,
            'borrow_date' => $loan->borrow_date,
            'return_date' => $loan->return_date,
            'quantity' => $loan->quantity,
        ];

        // Mail::to($loan->opa->email)->send(new LoanApprovedMail($data));
        Mail::to($data['email'])->send(new LoanApprovedMail($data));


        return redirect()->route('loans.index')->with('success', ' Berhasil diACC.');
    }
    // public function accept($id)
    // {
    //     // Ambil data loan berdasarkan ID
    //     $loan = Loan::with('user')->findOrFail($id);

    //     // Update status
    //     $loan->update([
    //         'status' => 'approved'
    //     ]);

    //     // Pastikan user punya email
    //     if ($loan->user && $loan->user->email) {

    //         // Data untuk email
    //         $data = [
    //             'name'  => $loan->user->full_name,
    //             'id'    => $loan->id,
    //             'email' => $loan->user->email
    //         ];

    //         // Kirim email
    //         Mail::to($loan->user->email)
    //             ->send(new LoanApprovedMail($data));
    //     }

    //     return redirect()
    //         ->route('loans.index')
    //         ->with('success', 'Berhasil di-ACC dan email sudah dikirim.');
    // }


    public function reject($loan)
    {
        $loan = Loan::with('details.item')->findOrFail($loan);

        // Tambah quantity item berdasarkan detail
        foreach ($loan->details as $detail) {
            $item = $detail->item;

            $item->quantity += $detail->quantity;
            $item->save();
        }

        // Update status loan
        $loan->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Berhasil ditolak.');
    }


    public function approve($loan)
    {
        //dd($loan);

        $loan = Loan::findOrFail($loan);

        $loan->update(['status' => 'borrowed']);

        return redirect()->back()->with('success', ' Berhasil dipinjam.');
    }

    public function borrowed($loan)
    {
        // Ambil loan
        $loan = Loan::with('details.item')->findOrFail($loan);

        // Tambahkan quantity item kembali
        foreach ($loan->details as $detail) {
            $item = $detail->item;

            // Tambah quantity berdasarkan jumlah yang dipinjam
            $item->quantity += $detail->quantity;
            $item->save();
        }

        // Update status loan
        $loan->update(['status' => 'returned']);

        return redirect()->back()->with('success', 'Berhasil dikembalikan.');
    }

    public function manage(Loan $loan)
    {
        $categories = Category::all();

        $selectedItems = LoanDetail::where('loan_id', $loan->id)
            ->pluck('item_id')
            ->toArray();

        $loanDetailsQuantity = LoanDetail::where('loan_id', $loan->id)
            ->pluck('quantity', 'item_id')  // array: item_id => quantity
            ->toArray();

        $items = Item::with('category')->where('quantity', '>=', -0)->get();


        $opas = Opa::all();
        $users = User::whereNot('role', 'admin')->get();

        return view('dashboard.loans.manage', compact('loan', 'opas', 'users', 'items', 'categories', 'selectedItems',  'loanDetailsQuantity',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        if ($request->hasFile('loan_document')) {
            $validated['loan_document'] = $request->file('loan_document')
                ->store('loanDocuments', 'public');
        }


        Loan::create($validated);

        return redirect()->back()->with('success', 'Pengajuan peminjaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        return view('dashboard.loans.detail', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function showNotification(Loan $loan)
    {
        return view('dashboard.loans.notifikasiShow', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        // dd($request->all());

        $validated = $request->validated();

        // Jika ada dokumen baru di-upload
        if ($request->hasFile('loan_document')) {

            // Hapus file lama kalau ada
            if ($loan->loan_document && Storage::disk('public')->exists($loan->loan_document)) {
                Storage::disk('public')->delete($loan->loan_document);
            }

            // Simpan file baru
            $validated['loan_document'] = $request->file('loan_document')
                ->store('loanDocuments', 'public');
        }

        // Update data di database
        $loan->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->details()->delete();

        $loan->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
