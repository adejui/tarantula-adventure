@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900">Artikel</h1>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Artikel</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-16">
                    @forelse ($articles as $article)
                        <article class="flex flex-col gap-6">

                            <h2
                                class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight hover:text-[#7C3AED] transition-colors">
                                <a href="{{ route('frontend.articles.show', $article->slug ?? '#') }}">
                                    {{ $article->title }}
                                </a>
                            </h2>

                            <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-sm">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://source.unsplash.com/800x450/?mountain,hiker' }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            </div>

                            <div class="text-sm text-gray-500 font-medium">
                                {{ $article->location ?? 'Yogyakarta' }},
                                {{ \Carbon\Carbon::parse($article->created_at)->isoFormat('D MMMM Y') }}
                                <span class="mx-2">•</span>
                                {{ $article->author->name ?? 'Admin' }}
                            </div>

                            <div class="text-gray-600 leading-relaxed text-justify space-y-4">
                                {{-- Ambil 300 karakter pertama --}}
                                <p>
                                    {{ Str::limit(strip_tags($article->content), 350) }}
                                </p>
                            </div>

                            {{-- 
                            <div>
                                <a href="{{ route('frontend.articles.show', $article->slug) }}" class="text-[#7C3AED] font-bold hover:underline">
                                    Baca Selengkapnya →
                                </a>
                            </div> 
                            --}}

                        </article>
                    @empty
                        <div class="text-center py-20 bg-gray-50 rounded-3xl">
                            <p class="text-gray-500">Belum ada artikel yang diterbitkan.</p>
                        </div>
                    @endforelse

                    <div class="pt-10">
                        {{ $articles->links('vendor.pagination.tailwind') }}
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-32">

                        <h3 class="text-xl font-bold text-gray-900 mb-6">Artikel Terbaru</h3>

                        <div class="space-y-6">
                            @foreach ($recentArticles as $recent)
                                <a href="{{ route('frontend.articles.show', $recent->slug ?? '#') }}"
                                    class="group flex gap-4 items-start">

                                    <div class="w-24 h-24 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                        <img src="{{ $recent->image ? asset('storage/' . $recent->image) : 'https://source.unsplash.com/200x200/?nature,forest' }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <h4
                                            class="text-sm font-bold text-gray-900 leading-snug line-clamp-3 group-hover:text-[#7C3AED] transition-colors">
                                            {{ $recent->title }}
                                        </h4>

                                        <div class="flex items-center gap-2 text-xs text-gray-400 mt-1">
                                            <i class="fa-regular fa-clock"></i>
                                            <span>{{ $recent->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
