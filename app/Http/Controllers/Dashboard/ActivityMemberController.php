<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ActivityMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActivityMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'user_ids'    => 'nullable|string',
        ]);

        $userIds = $validated['user_ids'] ? json_decode($validated['user_ids'], true) : [];

        // Soft delete anggota lama
        ActivityMember::where('activity_id', $validated['activity_id'])->delete();

        if (empty($userIds)) {
            return back()->with('success', 'Anggota kegiatan berhasil diperbarui (kosong).');
        }

        // Insert anggota baru
        $data = collect($userIds)->map(function ($userId) use ($validated) {
            return [
                'activity_id' => $validated['activity_id'],
                'user_id'     => $userId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        })->toArray();

        ActivityMember::insert($data);

        return back()->with('success', 'Anggota kegiatan berhasil diperbarui!');
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
    public function destroy(string $id)
    {
        //
    }
}
