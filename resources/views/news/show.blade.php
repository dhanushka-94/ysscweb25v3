@extends('layouts.frontend')

@section('title', $news->title . ' - YSSC Football Club News')
@section('description', $news->excerpt ?: 'Latest news from Young Silver Sports Club. Stay updated with YSSC football club news, events, and announcements.')
@section('keywords', 'YSSC news, Young Silver Sports Club news, football club news, Colombo football news, YSSC updates, sports club news')
@section('og_title', $news->title . ' - YSSC Football Club')
@section('og_description', $news->excerpt ?: 'Latest news from Young Silver Sports Club. Stay updated with YSSC football club news, events, and announcements.')
@section('og_type', 'article')
@section('og_image', $news->featured_image ? asset('storage/' . $news->featured_image) : asset('images/og-image.jpg'))

@section('content')
    <!-- Article Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "{{ $news->title }}",
        "description": "{{ $news->excerpt ?: 'Latest news from Young Silver Sports Club' }}",
        "image": "{{ $news->featured_image ? asset('storage/' . $news->featured_image) : asset('images/og-image.jpg') }}",
        "datePublished": "{{ $news->published_at->format('c') }}",
        "dateModified": "{{ $news->updated_at->format('c') }}",
        "author": {
            "@type": "Organization",
            "name": "Young Silver Sports Club"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Young Silver Sports Club",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('storage/' . \App\Models\Setting::get('site_logo', 'images/logo.png')) }}"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
        }
    }
    </script>
    <!-- Article Header -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6">
                    <a href="{{ route('news') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">
                        ← Back to News
                    </a>
                </div>

                <article>
                    <header class="mb-8">
                        <div class="text-sm text-gray-600 mb-4">{{ $news->published_at->format('F d, Y') }}</div>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>
                        @if($news->excerpt)
                            <p class="text-xl text-gray-600">{{ $news->excerpt }}</p>
                        @endif
                    </header>

                    @if($news->featured_image)
                        <div class="mb-8 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-auto">
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </article>

                <!-- Related News -->
                @if($relatedNews->count() > 0)
                    <div class="mt-16 pt-16 border-t border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Related News</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedNews as $related)
                                <article class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                                    @if($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                                    @else
                                        <div class="w-full h-40 bg-gradient-to-br from-yellow-400 to-yellow-500"></div>
                                    @endif
                                    <div class="p-4">
                                        <div class="text-xs text-gray-600 mb-2">{{ $related->published_at->format('M d, Y') }}</div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ Str::limit($related->title, 60) }}</h3>
                                        <a href="{{ route('news.show', $related->slug) }}" class="text-yellow-600 font-semibold hover:text-yellow-700 text-sm">
                                            Read More →
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

