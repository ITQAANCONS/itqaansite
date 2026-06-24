@props([
    'variant' => 'default', // default | white
    'markOnly' => false,
    'class' => 'h-9',
])

@php
    $white = $variant === 'white';
    $wordColor = $white ? '#ffffff' : '#226b9f';
    $subColor  = $white ? 'rgba(255,255,255,.75)' : '#27abe3';
    $uid = 'lg' . substr(md5($variant . ($markOnly ? '1' : '0')), 0, 6);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 ' . $class]) }} aria-label="ITQAAN">
    {{-- Q mark --}}
    <svg viewBox="0 0 64 64" class="h-full w-auto shrink-0" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
            <linearGradient id="{{ $uid }}" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0" stop-color="{{ $white ? '#ffffff' : '#226b9f' }}"/>
                <stop offset="1" stop-color="{{ $white ? '#ffffff' : '#27abe3' }}"/>
            </linearGradient>
        </defs>
        <path fill="url(#{{ $uid }})"
              d="M30 2C14.5 2 2 14.5 2 30s12.5 28 28 28c5.2 0 10-1.4 14.2-3.9l8 8a5 5 0 0 0 7.1-7.1l-7.6-7.6A27.9 27.9 0 0 0 58 30C58 14.5 45.5 2 30 2Zm0 16a12 12 0 1 1 0 24 12 12 0 0 1 0-24Z"/>
    </svg>

    @unless($markOnly)
        <span class="flex flex-col leading-none" style="line-height:1">
            <span class="text-[1.45em] font-extrabold tracking-tight" style="color: {{ $wordColor }}; font-family: 'Tajawal', sans-serif;">ITQAAN</span>
            <span class="mt-0.5 text-[0.5em] font-semibold uppercase tracking-[0.18em]" style="color: {{ $subColor }};">Information Technology</span>
        </span>
    @endunless
</span>
