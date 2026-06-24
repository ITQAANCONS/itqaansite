@php
    $locale = $locale ?? app()->getLocale();
    $dir = $dir ?? ($locale === 'ar' ? 'rtl' : 'ltr');
    $companyName = \App\Support\Site::t(config('site.company.name'));
    $pageTitle = trim(($title ?? '') !== '' ? $title . ' — ' . $companyName : $companyName);
    $metaDesc = $description ?? \App\Support\Site::t(config('site.company.tagline'));
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="theme-color" content="#226b9f">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Hreflang alternates --}}
    @foreach (['ar', 'en'] as $alt)
        <link rel="alternate" hreflang="{{ $alt }}"
              href="{{ url(preg_replace('#^/(ar|en)#', '/'.$alt, request()->getPathInfo())) }}">
    @endforeach

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $companyName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.svg') }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_SA' : 'en_US' }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-mark.svg') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    {{-- Structured data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "{{ $companyName }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo-mark.svg') }}",
        "email": "{{ config('site.contact.email') }}",
        "address": { "@@type": "PostalAddress", "addressCountry": "SA" }
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-white font-sans text-slate-700 selection:bg-brand-100">

    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:m-3 focus:rounded-lg focus:bg-brand-600 focus:px-4 focus:py-2 focus:text-white">
        {{ $locale === 'ar' ? 'تخطَّ إلى المحتوى' : 'Skip to content' }}
    </a>

    <x-navbar />

    <main id="main">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
