<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\ActivityPhoto;
use App\Models\ActivityMember;
use App\Models\ActivityDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

    public function listActivity(Request $request)
    {
        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');
        $type = $request->get('type');

        $query = Activity::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        if ($type && $type !== 'all') $query->where('activity_type', $type);

        $activities = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            return view('dashboard.admin.activities.partials.table', compact('activities'))->render();
        }

        return view('dashboard.admin.activities.list', compact('activities'));
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
        $activity_documentation = ActivityDocument::where('activity_id', $activity->id)
            ->latest()
            ->first() ?? null;

        $activity_photos = ActivityPhoto::where('activity_id', $activity->id)
            ->latest()
            ->take(12)
            ->get();

        $activity_members = ActivityMember::where('activity_id', $activity->id)->get();

        return view('dashboard.admin.activities.detail', compact('activity', 'activity_members', 'activity_documentation', 'activity_photos'));
    }

    public function manage(Activity $activity)
    {
        // dd($activity);

        $generations = User::whereNotNull('generation')
            ->distinct()
            ->orderBy('generation', 'asc')
            ->pluck('generation');


        $selectedMembers = ActivityMember::where('activity_id', $activity->id)
            ->pluck('user_id')
            ->toArray();

        $activityDocument = ActivityDocument::where('activity_id', $activity->id)->first();

        $users = User::where('role', '!=', 'admin')->get();

        return view('dashboard.admin.activities.manage', compact('users', 'activity', 'activityDocument', 'selectedMembers', 'generations'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('dashboard.admin.activities.edit');
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
        if ($activity->divsc_photos) {
            foreach ($activity->divsc_photos as $photo) {

                if ($photo->photo_path && Storage::disk('public')->exists($photo->photo_path)) {
                    Storage::disk('public')->delete($photo->photo_path);
                }

                $photo->delete();
            }
        }

        if ($activity->activity_photos) {
            foreach ($activity->activity_photos as $photo) {

                if ($photo->photo_path && Storage::disk('public')->exists($photo->photo_path)) {
                    Storage::disk('public')->delete($photo->photo_path);
                }

                $photo->delete();
            }
        }

        $activity->documentations()->delete(); // TIDAK hapus file storage
        $activity->members()->delete();
        $activity->articles()->delete();

        $activity->delete();

        return redirect()
            ->route('list.activity')
            ->with('success', 'Activity & seluruh foto terkait berhasil dihapus.');
    }
}
