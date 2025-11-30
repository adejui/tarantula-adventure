<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Opa;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = User::where('status', '!=', 'admin')->count();
        $activity = Activity::count();
        $item = Item::count();
        $category = Category::count();
        $loan = Loan::count();
        $opa = Opa::distinct('name')->count('name');

        return view('dashboard.dashboard', compact('user', 'activity', 'item', 'loan', 'category', 'opa'));
    }
}
