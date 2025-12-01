<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');

        // --- LOGIC 1: PENCARIAN (SEARCH) ---
        // Jika user mengetik sesuatu di kolom search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%');
            });
        }

        // --- LOGIC 2: FILTER KATEGORI ---
        // Jika user memilih kategori selain "Semua"
        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // --- LOGIC 3: PENGURUTAN (SORT) ---
        // Cek pilihan user, defaultnya 'Terbaru'
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'Terlama':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'A-Z':
                    $query->orderBy('name', 'asc');
                    break;
                case 'Terbaru':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default jika tidak memilih apa-apa
            $query->orderBy('created_at', 'desc');
        }

        // 4. Eksekusi Pagination
        // withQueryString() PENTING: Supaya saat klik Halaman 2, filter pencarian tidak hilang
        $items = $query->paginate(10)->withQueryString();

        // (Opsional) Ambil data kategori untuk dropdown (biar ga manual ngetik di HTML)
        $categories = Category::all();

        return view('frontend.inventory.index', compact('items', 'categories'));
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
