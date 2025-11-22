<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getEvents()
    {
        $colorMap = [
            'primary' => '#DBEAFE',
            'success' => '#DCFCE7',
            'warning' => '#FEF9C3',
            'danger'  => '#FECACA',
            'orange' => '#FFE4B5',
        ];

        $activities = Activity::all();

        return response()->json(
            $activities->map(function ($activity) use ($colorMap) {
                return [
                    'id'    => $activity->id,
                    'title' => $activity->title,
                    'start' => date('Y-m-d', strtotime($activity->start_date)),
                    'end'   => date('Y-m-d', strtotime($activity->end_date . ' +1 day')),
                    'backgroundColor' => $colorMap[$activity->color] ?? '#DBEAFE',
                    'borderColor'     => $colorMap[$activity->color] ?? '#DBEAFE',

                    'extendedProps' => [
                        'color'         => $activity->color,
                        'activity_type' => $activity->activity_type,
                        'location'      => $activity->location,
                        'description'   => $activity->description,
                    ]
                ];
            })
        );
    }

    public function index()
    {
        $perPage = request('perPage', 5); // default 10

        $activities  = Activity::paginate($perPage);
        return view('dashboard.admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        $colorMap = [
            'meeting' => 'primary',
            'basic training' => 'warning',
            'exploration' => 'success',
            'anniversary' => 'orange',
            'others' => 'danger',
        ];

        $validated['color'] = $colorMap[$validated['activity_type']] ?? 'danger';

        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Kegiatan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $validated = $request->validated();

        $colorMap = [
            'meeting' => 'primary',
            'basic training' => 'warning',
            'exploration' => 'success',
            'anniversary' => 'orange',
            'others' => 'danger',
        ];

        $validated['color'] = $colorMap[$validated['activity_type']] ?? 'danger';

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
