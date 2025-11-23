<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ActivityDocument;
use App\Http\Controllers\Controller;

class ActivityDocumentController extends Controller
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
            'activity_id'        => 'required|exists:activities,id',
            'google_drive_link'  => 'nullable|string|max:255',
        ], [
            'activity_id.required' => 'Kegiatan wajib dipilih.',
            'activity_id.exists'   => 'Kegiatan yang dipilih tidak valid.',

            'google_drive_link.string' => 'Link Google Drive harus berupa teks.',
            'google_drive_link.max'    => 'Link Google Drive maksimal 255 karakter.',
        ]);

        // HAPUS dokumentasi lama milik activity yang sama
        ActivityDocument::where('activity_id', $validated['activity_id'])->delete();

        // Simpan dokumentasi baru
        ActivityDocument::create($validated);

        return redirect()->back()->with('success', 'Dokumentasi kegiatan berhasil diperbarui!');
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
