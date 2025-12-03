<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PublicActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query();

        if ($request->get('type') == 'meeting') {

            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $query->where('activity_type', 'meeting');
        } else {
            $query->where('activity_type', '!=', 'meeting');
        }

        $query->orderBy('start_date', 'asc');

        $allActivities = $query->get();

        $events = $allActivities->map(function ($activity) {
            return [
                'title' => $activity->title,
                'start' => Carbon::parse($activity->start_date)->format('Y-m-d'),
                'color' => $activity->color ?? '#7C3AED',
                'type'  => $activity->activity_type
            ];
        });

        $upcomingActivities = $allActivities->filter(function ($act) {
            return Carbon::parse($act->start_date)->endOfDay()->isFuture()
                || Carbon::parse($act->start_date)->isToday();
        })->take(3);

        return view('frontend.activities.index', compact('events', 'upcomingActivities'));
    }
}
