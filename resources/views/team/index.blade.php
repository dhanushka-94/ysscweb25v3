@extends('layouts.frontend')

@section('title', 'Our Team - ' . config('app.name'))
@section('description', 'Meet our talented team members from different categories including main team, youth teams, coaching staff, and management.')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Team</h1>
        <p class="text-lg md:text-xl text-gray-800">Meet the talented individuals who make up our football club family</p>
    </div>
</section>


<!-- Team Categories -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($categories->count() > 0)
            <!-- Search Bar -->
            <div class="mb-12">
                <div class="max-w-md mx-auto">
                    <div class="relative">
                        <input type="text" 
                               id="teamSearch" 
                               placeholder="Search team members..." 
                               class="w-full px-4 py-3 pl-12 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($categories as $category)
                @if($category->teams->count() > 0)
                    <div class="mb-16 team-category" data-category="{{ strtolower($category->name) }}">
                        <!-- Category Header -->
                        <div class="text-center mb-12">
                            <div class="inline-flex items-center space-x-3 mb-4">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-300" style="background-color: {{ $category->color }}"></div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $category->name }}</h2>
                            </div>
                            @if($category->description)
                                <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $category->description }}</p>
                            @endif
                        </div>

                        <!-- Team Members Grid - 5 per row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach($category->teams as $member)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 team-member" 
                                     data-name="{{ strtolower($member->name) }}" 
                                     data-position="{{ strtolower($member->position) }}"
                                     data-nationality="{{ strtolower($member->nationality ?? '') }}">
                                    <!-- Member Photo - Top Center Aligned -->
                                    <div class="relative flex justify-center pt-6 pb-4">
                                        @if($member->photo)
                                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-yellow-400 shadow-lg">
                                                <img src="{{ asset('storage/' . $member->photo) }}" 
                                                     alt="{{ $member->name }}" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center border-4 border-yellow-400 shadow-lg">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Jersey Number Badge -->
                                        @if($member->jersey_number)
                                            <div class="absolute top-2 right-2 bg-yellow-400 text-gray-900 px-2 py-1 rounded-full font-bold text-sm">
                                                #{{ $member->jersey_number }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Member Details -->
                                    <div class="px-6 pb-6 text-center">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $member->name }}</h3>
                                        <p class="text-yellow-600 font-semibold mb-2 text-sm">{{ $member->position }}</p>
                                        
                                        @if($member->nationality)
                                            <p class="text-gray-600 text-xs mb-3">{{ $member->nationality }}</p>
                                        @endif

                                        @if($member->bio)
                                            <p class="text-gray-700 text-xs leading-relaxed">{{ Str::limit($member->bio, 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Team Members Found</h3>
                <p class="text-gray-600 mb-4">Team members will be displayed here once they are added.</p>
                <a href="{{ route('member-application.create') }}" class="text-yellow-600 hover:text-yellow-700 font-medium">
                    Apply to join our team
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Want to Join Our Team?</h2>
        <p class="text-xl text-gray-300 mb-8">Be part of our football family and showcase your talent</p>
        <a href="{{ route('member-application.create') }}" 
           class="inline-flex items-center bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Apply Now
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('teamSearch');
    const teamMembers = document.querySelectorAll('.team-member');
    const teamCategories = document.querySelectorAll('.team-category');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            teamMembers.forEach(member => {
                const name = member.getAttribute('data-name') || '';
                const position = member.getAttribute('data-position') || '';
                const nationality = member.getAttribute('data-nationality') || '';
                
                const matches = name.includes(searchTerm) || 
                               position.includes(searchTerm) || 
                               nationality.includes(searchTerm);
                
                if (matches) {
                    member.style.display = 'block';
                } else {
                    member.style.display = 'none';
                }
            });

            // Show/hide categories based on visible members
            teamCategories.forEach(category => {
                const visibleMembers = category.querySelectorAll('.team-member[style*="block"], .team-member:not([style*="none"])');
                if (visibleMembers.length > 0) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });

            // Show "No results" message if no members are visible
            const hasVisibleMembers = Array.from(teamMembers).some(member => 
                member.style.display !== 'none'
            );

            let noResultsMessage = document.getElementById('noResultsMessage');
            if (!hasVisibleMembers && searchTerm.length > 0) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement('div');
                    noResultsMessage.id = 'noResultsMessage';
                    noResultsMessage.className = 'text-center py-16 col-span-full';
                    noResultsMessage.innerHTML = `
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No team members found</h3>
                        <p class="text-gray-600">Try searching with different keywords</p>
                    `;
                    document.querySelector('.py-16.bg-white .max-w-7xl').appendChild(noResultsMessage);
                }
                noResultsMessage.style.display = 'block';
            } else if (noResultsMessage) {
                noResultsMessage.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
