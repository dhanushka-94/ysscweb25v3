# Admin Panel Setup Guide

## Admin Controllers

The following admin controllers need to be created for full CRUD functionality. These would follow the same pattern as the dashboard controller:

### Controllers to Create:
1. `Admin\AdminNewsController` - Manage news articles
2. `Admin\AdminFixtureController` - Manage fixtures
3. `Admin\AdminGalleryController` - Manage gallery images  
4. `Admin\AdminSponsorController` - Manage sponsors
5. `Admin\AdminProductController` - Manage shop products
6. `Admin\AdminOfficeBearerController` - Manage office bearers
7. `Admin\AdminAboutContentController` - Manage about content

### Creating Admin Controllers

Use Laravel's resource controllers:

```bash
php artisan make:controller Admin/AdminNewsController --resource
php artisan make:controller Admin/AdminFixtureController --resource
php artisan make:controller Admin/AdminGalleryController --resource
php artisan make:controller Admin/AdminSponsorController --resource
php artisan make:controller Admin/AdminProductController --resource
php artisan make:controller Admin/AdminOfficeBearerController --resource
php artisan make:controller Admin/AdminAboutContentController --resource
```

### Example Controller Structure

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}
```

### Creating Admin Views

Create corresponding views in `resources/views/admin/`:

```
resources/views/admin/
├── news/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── fixtures/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── [etc...]
```

### Example Admin View (List)

```blade
@extends('admin.layout')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Manage News</h1>
            <a href="{{ route('admin.news.create') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                Add New
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($news as $article)
                    <tr>
                        <td class="px-6 py-4">{{ $article->title }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $article->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $article->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.news.edit', $article) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
```

## File Upload Configuration

For image uploads to work properly:

1. Ensure storage is linked:
```bash
php artisan storage:link
```

2. Update `.env` for file uploads:
```env
FILESYSTEM_DISK=public
```

3. Create necessary directories:
```bash
mkdir -p storage/app/public/news
mkdir -p storage/app/public/gallery
mkdir -p storage/app/public/products
mkdir -p storage/app/public/sponsors
mkdir -p storage/app/public/office-bearers
```

## Security

- All admin routes are protected by authentication and admin middleware
- File uploads should be validated for type and size
- Always sanitize user input
- Use CSRF protection (already included in Laravel)

## Quick Start

1. Create your first admin user (see README.md)
2. Login at `/login`
3. Access admin panel at `/admin`
4. Start adding content!

