<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Opa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpaRequest;

class OpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Dropdown organizations
        $organizations = Opa::selectRaw('LOWER(organization_name) as organization_name')
            ->whereNotNull('organization_name')
            ->distinct()
            ->orderBy('organization_name', 'asc')
            ->pluck('organization_name');

        // Dropdown campuses
        $campuses = Opa::selectRaw('LOWER(campus_name) as campus_name')
            ->whereNotNull('campus_name')
            ->distinct()
            ->orderBy('campus_name', 'asc')
            ->pluck('campus_name');

        $perPage = $request->get('perPage', 5);

        // Filter input
        $search       = $request->get('search');
        $organization = $request->get('organization');
        $campus       = $request->get('campus');

        $query = Opa::query();

        // Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter organization
        if ($organization && $organization !== 'all') {
            $query->whereRaw('LOWER(organization_name) = ?', [strtolower($organization)]);
        }

        // Filter campus
        if ($campus && $campus !== 'all') {
            $query->whereRaw('LOWER(campus_name) = ?', [strtolower($campus)]);
        }

        // ================================================
        // GROUP BY NAME (case-insensitive), AMBIL DATA TERBARU
        // ================================================
        $subLatest = Opa::selectRaw("
        LOWER(name) as name_key,
        MAX(id) as latest_id
    ")
            ->groupBy('name_key');

        $query = $query->joinSub($subLatest, 'latest_data', function ($join) {
            $join->on(DB::raw('LOWER(opas.name)'), '=', 'latest_data.name_key');
        })
            ->selectRaw("
        MIN(opas.id) as id,
        opas.name,

        (SELECT email 
            FROM opas o1 
            WHERE LOWER(o1.name) = LOWER(opas.name) 
            ORDER BY id DESC 
            LIMIT 1
        ) as email,

        (SELECT phone_number 
            FROM opas o2 
            WHERE LOWER(o2.name) = LOWER(opas.name) 
            ORDER BY id DESC 
            LIMIT 1
        ) as phone_number,

        (SELECT campus_name 
            FROM opas o3 
            WHERE LOWER(o3.name) = LOWER(opas.name) 
            ORDER BY id DESC 
            LIMIT 1
        ) as campus_name,

        (SELECT organization_name 
            FROM opas o4 
            WHERE LOWER(o4.name) = LOWER(opas.name) 
            ORDER BY id DESC 
            LIMIT 1
        ) as organization_name,

        (SELECT created_at
            FROM opas o5
            WHERE LOWER(o5.name) = LOWER(opas.name)
            ORDER BY id DESC
            LIMIT 1
        ) as latest_created_at,

        COUNT(*) as total_peminjaman
    ")
            ->groupBy('opas.name')
            ->orderBy('latest_created_at', 'DESC');


        $opas = $query->paginate($perPage)->appends($request->all());


        if ($request->ajax()) {
            return view('dashboard.admin.opas.partials.table', compact('opas'))->render();
        }

        return view('dashboard.admin.opas.index', compact('opas', 'organizations', 'campuses'));
    }







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpaRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        Opa::create($validated);

        return redirect()->route('opas.index')->with('success', 'Data peminjam berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opa $opa)
    {
        $opa->delete();

        return redirect()->route('opas.index')->with('success', 'Data Peminjam berhasil dihapus!');
    }
}
