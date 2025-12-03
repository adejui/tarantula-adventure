<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Article;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');

        $query = Article::query()->orderBy('created_at', 'DESC');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");;
        }

        $articles = $query->paginate($perPage)->appends($request->all());

        if ($request->ajax()) {
            // Partial view hanya isi tabel
            return view('dashboard.admin.articles.partials.table', compact('articles'))->render();
        }

        return view('dashboard.admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = Activity::all();

        return view('dashboard.admin.articles.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => ['required', 'exists:activities,id'],
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:your_table_name,slug'],
            'content'     => ['required'],
            'status'      => ['required', 'in:draft,published'],
            'file_path'   => ['nullable', 'file', 'mimes:png,jpg,jpeg,pdf,doc,docx', 'max:2048'],
        ], [
            // Pesan validasi
            'activity_id.required' => 'Activity wajib dipilih.',
            'activity_id.exists'   => 'Activity tidak valid.',

            'title.required' => 'Judul wajib diisi.',
            'title.max'      => 'Judul terlalu panjang.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.unique'   => 'Slug sudah digunakan.',
            'slug.max'      => 'Slug terlalu panjang.',

            'content.required' => 'Konten wajib diisi.',

            'status.required' => 'Status wajib dipilih.',
            'status.in'       => 'Status harus draft atau published.',

            'file_path.required' => 'File wajib diunggah.',
            'file_path.file'     => 'Format file tidak valid.',
            'file_path.mimes'    => 'File harus berupa png, jpg, jpeg, pdf, doc, atau docx.',
            'file_path.max'      => 'Ukuran file maksimal 2MB.',
        ]);


        $slug = Str::slug($request->title);
        $count = Article::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $filePath = null;

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('thumbnails', 'public');
        }

        Article::create([
            'activity_id' => $request->activity_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'content'     => $request->content,
            'status'      => $request->status,
            'file_path'   => $filePath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
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
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
