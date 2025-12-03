<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index()
    {
        // 1. Ambil Artikel Utama (Kiri) - Pagination 5 per halaman
        // $articles = Article::with('author') // Asumsi ada relasi author
        //             ->latest()
        //             ->paginate(5);

        // 2. Ambil Artikel Terbaru untuk Sidebar (Kanan) - Limit 5
        // Kita exclude artikel yang sedang tampil di halaman 1 agar tidak duplikat (opsional)
        // $recentArticles = Article::latest()->take(5)->get();

        return view('frontend.articles.index'); // compact('articles', 'recentArticles')
    }

    // public function show($slug)
    // {
    //     // Untuk halaman detail nanti (Single Page)
    //     $article = Article::where('slug', $slug)->firstOrFail();
    //     $recentArticles = Article::latest()->take(5)->get();

    //     return view('frontend.articles.show', compact('article', 'recentArticles'));
    // }
}
