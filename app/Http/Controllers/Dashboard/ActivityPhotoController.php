<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ActivityPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ActivityPhotoController extends Controller
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
        // dd($request->all());

        $request->validate([
            'activity_id'     => 'required|exists:activities,id',
            'photos.*'        => 'image|mimes:jpg,jpeg,png|max:5120',
            'deleted_photos'  => 'nullable',
        ], [
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'photos.*.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->deleted_photos) {
            $deleted = json_decode($request->deleted_photos, true);

            foreach ($deleted as $id) {
                $photo = ActivityPhoto::find($id);
                if ($photo) {
                    Storage::delete($photo->photo_path);
                    $photo->delete();
                }
            }
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('activityPhotos', 'public');

                ActivityPhoto::create([
                    'activity_id' => $request->activity_id,
                    'photo_path'  => $path,
                ]);
            }
        }

        return back()->with('success', 'Foto kegiatan berhasil diperbarui!');
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
