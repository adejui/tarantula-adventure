<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');
        $category = $request->get('category');

        $query = Item::query()->with('category'); // biar relasi category bisa diakses

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (!empty($category) && $category !== 'all') {
            $query->where('category_id', $category);
        }

        $items = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            return view('dashboard.admin.items.partials.table', compact('items'))->render();
        }

        return view('dashboard.admin.items.index', compact('items', 'categories'));
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
    // public function generateCode($categoryId)
    // {
    //     $category = Category::findOrFail($categoryId);
    //     $name = $category->name;

    //     // Buat 3 huruf otomatis tapi tetap mudah dibaca dan unik
    //     $words = explode(' ', $name);

    //     if (count($words) >= 2) {
    //         // Ambil huruf pertama dari 2 kata pertama + huruf terakhir dari kata terakhir
    //         $prefix = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1) . substr(end($words), -1));
    //     } else {
    //         // Kalau cuma 1 kata, ambil 3 huruf pertama
    //         $prefix = strtoupper(substr($words[0], 0, 3));
    //     }

    //     // Cari kode terakhir dari kategori ini
    //     $latestItem = Item::where('category_id', $categoryId)
    //         ->orderBy('id', 'desc')
    //         ->first();

    //     if ($latestItem && preg_match('/-(\d{3})$/', $latestItem->code, $matches)) {
    //         $number = (int)$matches[1] + 1;
    //     } else {
    //         $number = 1;
    //     }

    //     $formattedNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
    //     $code = "{$prefix}-{$formattedNumber}";

    //     return response()->json(['code' => $code]);
    // }

    public function generateCode($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $words = explode(' ', $category->name);

        // Prefix
        if (count($words) >= 2) {
            $prefix = strtoupper(
                substr($words[0], 0, 1) .
                    substr($words[1], 0, 1) .
                    substr(end($words), -1)
            );
        } else {
            $prefix = strtoupper(substr($words[0], 0, 3));
        }

        // Ambil kode terakhir dari kategori ini
        $latestItem = Item::where('category_id', $categoryId)
            ->orderBy('id', 'desc')
            ->first();

        if ($latestItem && preg_match('/-(\d{3})$/', $latestItem->code, $matches)) {
            $number = intval($matches[1]) + 1;
        } else {
            $number = 1;
        }

        $formattedNumber = str_pad($number, 3, '0', STR_PAD_LEFT);

        return response()->json([
            'code' => "{$prefix}-{$formattedNumber}"
        ]);
    }

    public function store(StoreItemRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();

        $item = Item::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'code' => $validated['code'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'] ?? null,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('items', 'public');

                ItemPhoto::create([
                    'item_id' => $item->id,
                    'photo_path' => $path,
                ]);
            }
        }

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('dashboard.admin.items.detail', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();

        return view('dashboard.admin.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // dd($request->all());

        $validated = $request->validated();

        // Cek apakah kategori berubah
        $categoryChanged = $item->category_id != $validated['category_id'];

        // Generate code baru jika kategori berubah
        if ($categoryChanged) {
            $validated['code'] = $this->generateCode($validated['category_id']);
        } else {
            $validated['code'] = $item->code;
        }

        // Update item basic data
        $item->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'code' => $validated['code'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'],
        ]);

        // Hapus Foto
        if (!empty($validated['deleted_photos'])) {
            $deletedIds = json_decode($validated['deleted_photos'], true);

            foreach ($deletedIds as $photoId) {
                $photo = ItemPhoto::find($photoId);
                if ($photo) {
                    Storage::disk('public')->delete($photo->photo_path);
                    $photo->delete();
                }
            }
        }

        // Upload Foto Baru
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo === null) continue; // skip null
                $path = $photo->store('items', 'public');

                ItemPhoto::create([
                    'item_id' => $item->id,
                    'photo_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Item berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Hapus semua foto item
        foreach ($item->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);

            $photo->delete();
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
