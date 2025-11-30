<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Activity;


class HomeController extends Controller
{
    public function index()
    {

        $inventoryItems = Item::with('category')->orderBy('id', 'desc')->take(5)->get();

        $activities = Activity::with('members') // <--- Load relasi members
                      ->orderBy('id', 'desc')
                      ->take(3)
                      ->get();

        return view('frontend.home.index', compact('inventoryItems', 'activities'));
    }
}
