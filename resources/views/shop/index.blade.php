@extends('layouts.frontend')

@section('title', 'Shop - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Club Shop</h1>
            <p class="text-xl text-gray-800">Get your official merchandise</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($categories->count() > 0)
                <div class="flex flex-wrap gap-2 mb-8 justify-center">
                    <a href="{{ route('shop') }}" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        All Products
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category]) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center">
                                        <span class="text-4xl font-bold text-white">{{ substr($product->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <div class="text-xs text-gray-600 mb-1">{{ $product->category }}</div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-yellow-600">${{ number_format($product->price, 2) }}</span>
                                    @if($product->stock > 0)
                                        <span class="text-xs text-green-600 font-semibold">In Stock</span>
                                    @else
                                        <span class="text-xs text-red-600 font-semibold">Out of Stock</span>
                                    @endif
                                </div>
                                <a href="{{ route('shop.show', $product->slug) }}" class="mt-4 block w-full text-center bg-yellow-400 text-gray-900 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No products available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

