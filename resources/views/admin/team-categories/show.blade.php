<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $teamCategory->name }} - Team Category - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.team-categories.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Team Categories
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full border-2 border-gray-300" style="background-color: {{ $teamCategory->color }}"></div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $teamCategory->name }}</h1>
                            <p class="text-gray-600">{{ $teamCategory->slug }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.team-categories.edit', $teamCategory) }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                            Edit Category
                        </a>
                        <a href="{{ route('admin.team.create') }}?category={{ $teamCategory->id }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600">
                            Add Team Member
                        </a>
                    </div>
                </div>

                @if($teamCategory->description)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700">{{ $teamCategory->description }}</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Display Order</h4>
                        <p class="text-gray-700">{{ $teamCategory->order }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Status</h4>
                        <span class="px-2 py-1 text-xs rounded-full {{ $teamCategory->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $teamCategory->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Team Members</h4>
                        <p class="text-gray-700">{{ $teams->total() }} members</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Team Members in {{ $teamCategory->name }}</h2>
                </div>

                @if($teams->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Photo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jersey #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($teams as $member)
                            <tr>
                                <td class="px-6 py-4">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="h-16 w-16 object-cover rounded-full">
                                    @else
                                        <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center text-xs text-gray-500">No Photo</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold">{{ $member->name }}</div>
                                    @if($member->nationality)
                                        <div class="text-sm text-gray-500">{{ $member->nationality }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $member->position }}</td>
                                <td class="px-6 py-4">{{ $member->jersey_number ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $member->order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.team.edit', $member) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                    <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-8 text-center text-gray-500">
                        <p>No team members in this category yet.</p>
                        <a href="{{ route('admin.team.create') }}?category={{ $teamCategory->id }}" class="text-yellow-600 hover:text-yellow-700 mt-2 inline-block">
                            Add the first team member
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</body>
</html>
