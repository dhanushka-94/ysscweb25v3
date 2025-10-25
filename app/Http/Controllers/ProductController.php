<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Shop', 'url' => null]
        ];
        
        return view('shop.index', compact('products', 'categories', 'breadcrumbs'));
    }

    public function show(Product $product)
    {
        if (!$product->is_available) {
            abort(404);
        }
        
        $relatedProducts = Product::where('is_available', true)
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Shop', 'url' => route('shop')],
            ['title' => $product->name, 'url' => null]
        ];
        
        return view('shop.show', compact('product', 'relatedProducts', 'breadcrumbs'));
    }
}
