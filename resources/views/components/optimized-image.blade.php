@props([
    'src' => '',
    'alt' => '',
    'loading' => 'lazy',
    'preload' => false,
    'class' => '',
    'sizes' => '100vw',
    'width' => null,
    'height' => null
])

@php
    $optimizedAttributes = \App\Helpers\ImageHelper::getOptimizedImageAttributes($src, $alt, $loading, $preload);
    $webpSrc = \App\Helpers\ImageHelper::getWebPImage($src);
    $isWebP = $webpSrc !== $src;
@endphp

<picture>
    @if($isWebP)
        <source srcset="{{ asset($webpSrc) }}" type="image/webp">
    @endif
    <img 
        src="{{ $optimizedAttributes['src'] }}"
        @if(isset($optimizedAttributes['data-src']))
            data-src="{{ $optimizedAttributes['data-src'] }}"
        @endif
        alt="{{ $optimizedAttributes['alt'] }}"
        loading="{{ $optimizedAttributes['loading'] }}"
        @if($preload)
            data-preload="true"
        @endif
        @if($width)
            width="{{ $width }}"
        @endif
        @if($height)
            height="{{ $height }}"
        @endif
        sizes="{{ $sizes }}"
        class="{{ $optimizedAttributes['class'] }} {{ $class }}"
        @if($loading === 'lazy')
            style="opacity: 0; transition: opacity 0.3s;"
        @endif
    >
</picture>
