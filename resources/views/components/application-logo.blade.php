@props(['variant' => 'colored'])

<img src="{{ asset($variant === 'white' ? 'images/vinix7-logo-white.png' : 'images/vinix7-logo.png') }}" 
     alt="VINIX7 - PT Vinix Seven Aurum" 
     {{ $attributes->merge(['class' => 'h-8 w-auto object-contain']) }} />
