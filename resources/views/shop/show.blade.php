@extends('layouts.frontend')

@section('title', $product->name . ' - Shop - YSSC Football Club')

@section('content')
    <!-- Product Detail -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="mb-6">
                    <a href="{{ route('shop') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">
                        ← Back to Shop
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Product Image -->
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
                        @else
                            <div class="w-full aspect-square bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg shadow-lg flex items-center justify-center">
                                <span class="text-9xl font-bold text-white">{{ substr($product->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div>
                        <div class="text-sm text-yellow-600 font-semibold mb-2">{{ $product->category }}</div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                        <div class="text-4xl font-bold text-yellow-600 mb-6">${{ number_format($product->price, 2) }}</div>

                        @if($product->size)
                            <div class="mb-4">
                                <span class="text-sm font-semibold text-gray-700">Size:</span>
                                <span class="text-sm text-gray-600">{{ $product->size }}</span>
                            </div>
                        @endif

                        @if($product->stock > 0)
                            <div class="mb-6 text-green-600 font-semibold">
                                {{ $product->stock }} items in stock
                            </div>
                        @else
                            <div class="mb-6 text-red-600 font-semibold">
                                Out of Stock
                            </div>
                        @endif

                        @if($product->description)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                            </div>
                        @endif

                        <button 
                            class="w-full bg-yellow-400 text-gray-900 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition @if($product->stock <= 0) opacity-50 cursor-not-allowed @endif"
                            @if($product->stock <= 0) disabled @endif
                        >
                            @if($product->stock > 0)
                                Add to Cart
                            @else
                                Out of Stock
                            @endif
                        </button>
                    </div>
                </div>

                <!-- Related Products -->
                @if($relatedProducts->count() > 0)
                    <div class="mt-20">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($relatedProducts as $related)
                                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                                    <a href="{{ route('shop.show', $related->slug) }}">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center">
                                                <span class="text-3xl font-bold text-white">{{ substr($related->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </a>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $related->name }}</h3>
                                        <span class="text-xl font-bold text-yellow-600">${{ number_format($related->price, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

