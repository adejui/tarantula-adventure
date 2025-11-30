<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanDetailRequest;

class LoanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $loan = Loan::findOrFail($request->input('loan_id'));

        $validated = $request->validate([
            'item_ids' => 'required|array|min:1',
            'item_ids.*' => 'exists:items,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'notes' => 'nullable|array',
            'notes.*' => 'nullable|string',
        ]);

        $existingDetails = $loan->details()->get()->keyBy('item_id'); // detail lama, keyed by item_id
        $newItemIds = $validated['item_ids'];

        // Handle item yang dihapus (tidak ada di $newItemIds)
        foreach ($existingDetails as $itemId => $detail) {
            if (!in_array($itemId, $newItemIds)) {
                // kembalikan stok ke item
                $item = Item::findOrFail($itemId);
                $item->quantity += $detail->quantity;
                $item->save();

                // hapus detail
                $detail->delete();
            }
        }

        // 2️⃣ Handle item baru / update quantity
        foreach ($newItemIds as $itemId) {
            $newQty = $validated['quantity'][$itemId];
            $note = $request->input("notes.$itemId", null);
            $item = Item::findOrFail($itemId);

            if (isset($existingDetails[$itemId])) {
                // detail sudah ada, cek selisih quantity
                $oldQty = $existingDetails[$itemId]->quantity;
                $diff = $newQty - $oldQty;

                if ($diff > 0) {
                    // tambah quantity → kurangi stok
                    if ($diff > $item->quantity) {
                        return back()->withErrors([
                            'quantity' => "Jumlah untuk item {$item->name} melebihi stok yang tersedia!",
                        ])->withInput();
                    }
                    $item->quantity -= $diff;
                } elseif ($diff < 0) {
                    // kurangi quantity → kembalikan stok
                    $item->quantity += abs($diff);
                }

                $item->save();

                // update detail
                $existingDetails[$itemId]->update([
                    'quantity' => $newQty,
                    'notes' => $note,
                ]);
            } else {
                // item baru → kurangi stok
                if ($newQty > $item->quantity) {
                    return back()->withErrors([
                        'quantity' => "Jumlah untuk item {$item->name} melebihi stok yang tersedia!",
                    ])->withInput();
                }
                $item->quantity -= $newQty;
                $item->save();

                // buat detail baru
                $loan->details()->create([
                    'item_id' => $itemId,
                    'quantity' => $newQty,
                    'notes' => $note,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Detail peminjaman berhasil diperbarui!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
