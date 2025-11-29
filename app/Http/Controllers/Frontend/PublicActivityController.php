<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class PublicActivityController extends Controller
{
    public function index()
    {

        // $activities = Activity::orderBy('start_date', 'asc')->paginate(5); compact('activities')
        return view('frontend.activities.index');
    }
}
