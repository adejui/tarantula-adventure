<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

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
}
