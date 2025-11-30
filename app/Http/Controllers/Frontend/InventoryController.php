<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('frontend.inventory.index', compact('items'));
    }

    public function show($id)
    {
        // Nanti disini logika ambil data detail barang by ID:
        // $item = Item::findOrFail($id);

        // Ambil data rekomendasi (dummy dulu buat tampilan bawah)
        // $relatedItems = Item::where('id', '!=', $id)->take(5)->get();

        // Kita kirim data dummy dulu biar view-nya jalan
        return view('frontend.inventory.show');
    }

    public function addToCart($id)
    {
        $item = Item::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $item->id,
                'name' => $item->name,
                'code' => $item->code,
                'category' => $item->category->name ?? 'Umum',
                'photo' => $item->photo,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'total' => collect(session('cart', []))->sum('qty')
        ]);
    }

    public function updateQty(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            // Kalau qty < 1, hapus item
            if ($qty < 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]['qty'] = $qty;
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'total' => collect(session('cart', []))->sum('qty')
        ]);
    }


    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $request->qty);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'total' => collect(session('cart', []))->sum('qty')
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'total' => collect(session('cart', []))->sum('qty')
        ]);
    }
}
