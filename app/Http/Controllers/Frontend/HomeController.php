<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {

        $inventoryItems = Item::with('category')->orderBy('id', 'desc')->take(5)->get();

        return view('frontend.home.index', compact('inventoryItems'));
    }
}
