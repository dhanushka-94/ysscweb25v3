@extends('layouts.frontend')

@section('title', 'Gallery - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Gallery</h1>
            <p class="text-xl text-gray-800">Memories and moments</p>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Gallery is now organized by titles automatically -->

            @if($groupedImages->count() > 0)
                @foreach($groupedImages as $galleryTitle => $images)
                    <!-- Gallery Title Section -->
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center border-b-2 border-yellow-400 pb-4">
                            {{ $galleryTitle }}
                        </h2>
                        
                        <!-- Images Grid for this Gallery (4x2 = 8 images max) -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
                            @php
                                $visibleImages = $images->take(8);
                                $hasMoreImages = $images->count() > 8;
                                $remainingCount = $images->count() - 8;
                            @endphp
                            
                            @foreach($visibleImages as $image)
                                <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition cursor-pointer" 
                                     onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}', '{{ $image->title }}', '{{ $image->description ?? '' }}')">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                                        <div class="p-4 text-white">
                                            @if($image->description)
                                                <p class="text-sm text-gray-200">{{ Str::limit($image->description, 60) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- View More Button (if more than 8 images) -->
                            @if($hasMoreImages)
                                <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition cursor-pointer bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center" 
                                     onclick="showAllImages('{{ $galleryTitle }}', {{ $images->count() }}, {{ $remainingCount }})">
                                    <div class="text-center text-gray-900">
                                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <p class="font-semibold text-sm">View More</p>
                                        <p class="text-xs">{{ $remainingCount }} more</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Hidden images for this gallery (shown when "View More" is clicked) -->
                        <div id="all-images-{{ Str::slug($galleryTitle) }}" class="hidden mt-6">
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4 max-w-7xl mx-auto">
                                @foreach($images->skip(8) as $image)
                                    <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition cursor-pointer" 
                                         onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}', '{{ $image->title }}', '{{ $image->description ?? '' }}')">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                                            <div class="p-4 text-white">
                                                @if($image->description)
                                                    <p class="text-sm text-gray-200">{{ Str::limit($image->description, 60) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No images available yet.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-yellow-400 text-4xl font-bold z-10">
                &times;
            </button>
            <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 text-white">
                <p id="lightbox-description" class="text-lg"></p>
            </div>
        </div>
    </div>

    <script>
        function openLightbox(imageSrc, title, description) {
            document.getElementById('lightbox-image').src = imageSrc;
            document.getElementById('lightbox-image').alt = title;
            document.getElementById('lightbox-description').textContent = description;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showAllImages(galleryTitle, totalCount, remainingCount) {
            const gallerySlug = galleryTitle.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            const allImagesDiv = document.getElementById('all-images-' + gallerySlug);
            const viewMoreButton = event.target.closest('.group');
            
            if (allImagesDiv.classList.contains('hidden')) {
                // Show all images
                allImagesDiv.classList.remove('hidden');
                viewMoreButton.innerHTML = `
                    <div class="text-center text-gray-900">
                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                        </svg>
                        <p class="font-semibold text-sm">Show Less</p>
                        <p class="text-xs">Hide ${remainingCount}</p>
                    </div>
                `;
            } else {
                // Hide all images
                allImagesDiv.classList.add('hidden');
                viewMoreButton.innerHTML = `
                    <div class="text-center text-gray-900">
                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <p class="font-semibold text-sm">View More</p>
                        <p class="text-xs">${remainingCount} more</p>
                    </div>
                `;
            }
        }

        // Close lightbox when clicking outside the image
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Close lightbox with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection

