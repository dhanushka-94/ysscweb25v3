@extends('layouts.frontend')

@section('title', 'News - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Latest News</h1>
            <p class="text-xl text-gray-800">Stay updated with YSSC FC</p>
        </div>
    </section>

    <!-- News Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    @foreach($news as $article)
                        <article class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-yellow-400 to-yellow-500"></div>
                            @endif
                            <div class="p-6">
                                <div class="text-sm text-gray-600 mb-2">{{ $article->published_at->format('F d, Y') }}</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $article->title }}</h3>
                                @if($article->excerpt)
                                    <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt, 120) }}</p>
                                @endif
                                <a href="{{ route('news.show', $article->slug) }}" class="inline-block text-yellow-600 font-semibold hover:text-yellow-700 transition">
                                    Read More →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $news->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No news articles available yet.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

