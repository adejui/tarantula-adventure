<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");;
            // Sesuaikan dengan kolom yang memang ada di tabel categories
        }

        $categories = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            // Partial view hanya isi tabel
            return view('dashboard.admin.categories.partials.table', compact('categories'))->render();
        }

        return view('dashboard.admin.categories.index', compact('categories'));
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
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());

        $validated = $request->validated();

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Data kategori berhasil ditambahkan!');
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request->all());

        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Data Kategori berhasil dihapus!');
    }
}
