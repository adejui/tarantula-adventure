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
}
