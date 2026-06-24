@php
    $locale = app()->getLocale();
    $alt = $locale === 'ar' ? 'en' : 'ar';
    $altUrl = url(preg_replace('#^/(ar|en)#', '/' . $alt, request()->getPathInfo()));

    $links = [
        ['route' => 'home',      'label' => __('site.nav.home')],
        ['route' => 'services',  'label' => __('site.nav.services')],
        ['route' => 'portfolio', 'label' => __('site.nav.portfolio')],
        ['route' => 'contact',   'label' => __('site.nav.contact')],
    ];
@endphp

<header data-navbar
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300
               [&.is-scrolled]:bg-white/90 [&.is-scrolled]:shadow-md [&.is-scrolled]:shadow-slate-900/5 [&.is-scrolled]:backdrop-blur-lg">
    <nav class="container-x flex h-18 items-center justify-between gap-4 py-3" aria-label="Main">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="z-10 shrink-0">
            <x-logo class="h-9 sm:h-10" />
        </a>

        {{-- Desktop links --}}
        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($links as $link)
                @php $active = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="relative rounded-lg px-4 py-2 text-sm font-semibold transition-colors
                          {{ $active ? 'text-brand-600' : 'text-slate-600 hover:text-brand-600' }}">
                    {{ $link['label'] }}
                    @if ($active)
                        <span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-brand-500"></span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Actions --}}
        <div class="z-10 flex items-center gap-2 sm:gap-3">
            <a href="{{ $altUrl }}"
               class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-sm font-bold text-slate-600 transition hover:border-brand-300 hover:text-brand-600"
               hreflang="{{ $alt }}" aria-label="Switch language">
                <x-icon name="globe" class="h-4 w-4" />
                {{ $alt === 'ar' ? 'العربية' : 'EN' }}
            </a>

            <a href="{{ route('request') }}" class="btn-primary hidden sm:inline-flex">
                {{ __('site.nav.request') }}
            </a>

            {{-- Mobile toggle --}}
            <button type="button" data-nav-toggle aria-expanded="false" aria-label="Toggle menu"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-700 hover:bg-slate-100 lg:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div data-nav-menu class="hidden border-t border-slate-100 bg-white/95 backdrop-blur-lg lg:hidden">
        <div class="container-x flex flex-col gap-1 py-4">
            @foreach ($links as $link)
                @php $active = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="rounded-lg px-4 py-3 text-base font-semibold transition
                          {{ $active ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('request') }}" class="btn-primary mt-2 w-full">
                {{ __('site.nav.request') }}
            </a>
        </div>
    </div>
</header>

{{-- Spacer for the fixed header --}}
<div class="h-18" aria-hidden="true"></div>
