@php
    use App\Support\Site;
    $locale = app()->getLocale();
    $alt = $locale === 'ar' ? 'en' : 'ar';
    $altUrl = url(preg_replace('#^/(ar|en)#', '/' . $alt, request()->getPathInfo()));
    $services = Site::services();

    // Simple links (the Solutions mega menu is rendered separately).
    $links = [
        ['route' => 'home',      'label' => __('site.nav.home')],
        ['route' => 'portfolio', 'label' => __('site.nav.portfolio')],
        ['route' => 'contact',   'label' => __('site.nav.contact')],
    ];
@endphp

<header data-navbar
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300
               [&.is-scrolled]:bg-white/90 [&.is-scrolled]:shadow-md [&.is-scrolled]:shadow-slate-900/5 [&.is-scrolled]:backdrop-blur-lg">
    <nav class="container-x relative flex h-18 items-center justify-between gap-4 py-3" aria-label="Main">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="z-10 shrink-0">
            <x-logo class="h-9 sm:h-10" />
        </a>

        {{-- Desktop links --}}
        <div class="hidden items-center gap-1 lg:flex">
            {{-- Home --}}
            @php $homeActive = request()->routeIs('home'); @endphp
            <a href="{{ route('home') }}"
               class="relative rounded-lg px-4 py-2 text-sm font-semibold transition-colors {{ $homeActive ? 'text-brand-600' : 'text-slate-600 hover:text-brand-600' }}">
                {{ __('site.nav.home') }}
                @if ($homeActive)<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-brand-500"></span>@endif
            </a>

            {{-- Solutions mega menu --}}
            <div class="group static">
                @php $solActive = request()->routeIs('services'); @endphp
                <button type="button"
                        class="relative inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-semibold transition-colors {{ $solActive ? 'text-brand-600' : 'text-slate-600 group-hover:text-brand-600' }}">
                    {{ __('site.nav.services') }}
                    <svg class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    @if ($solActive)<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-brand-500"></span>@endif
                </button>

                {{-- Panel --}}
                <div class="invisible absolute left-1/2 top-full z-40 w-[640px] max-w-[92vw] -translate-x-1/2 translate-y-1 opacity-0 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-2xl shadow-brand-600/10">
                        <div class="grid grid-cols-2 gap-1 p-3">
                            @foreach ($services as $service)
                                <a href="{{ route('services') }}#{{ $service['slug'] }}"
                                   class="group/item flex items-start gap-3 rounded-xl p-3 transition hover:bg-brand-50">
                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-50 to-brand-100 text-brand-600 transition group-hover/item:from-brand-600 group-hover/item:to-brand-400 group-hover/item:text-white">
                                        <x-icon :name="$service['icon'] ?? 'sparkles'" class="h-5 w-5" />
                                    </span>
                                    <span class="min-w-0">
                                        <span class="block text-sm font-bold text-slate-800">{{ Site::t($service['title']) }}</span>
                                        <span class="mt-0.5 block truncate text-xs text-slate-500">{{ Site::t($service['excerpt']) }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('services') }}" class="flex items-center justify-between border-t border-slate-100 bg-slate-50/70 px-5 py-3 text-sm font-bold text-brand-600 transition hover:bg-brand-50">
                            {{ __('site.nav.solutions_all') }}
                            <x-icon name="arrow" class="h-4 w-4 {{ $locale === 'ar' ? 'rotate-180' : '' }}" />
                        </a>
                    </div>
                </div>
            </div>

            {{-- Remaining links --}}
            @foreach ($links as $link)
                @continue($link['route'] === 'home')
                @php $active = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="relative rounded-lg px-4 py-2 text-sm font-semibold transition-colors {{ $active ? 'text-brand-600' : 'text-slate-600 hover:text-brand-600' }}">
                    {{ $link['label'] }}
                    @if ($active)<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-brand-500"></span>@endif
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
            <a href="{{ route('home') }}" class="rounded-lg px-4 py-3 text-base font-semibold {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('site.nav.home') }}</a>

            {{-- Solutions (collapsible, native) --}}
            <details class="group rounded-lg">
                <summary class="flex cursor-pointer list-none items-center justify-between rounded-lg px-4 py-3 text-base font-semibold text-slate-700 hover:bg-slate-50">
                    {{ __('site.nav.services') }}
                    <svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                </summary>
                <div class="mt-1 grid grid-cols-1 gap-0.5 ps-2">
                    @foreach ($services as $service)
                        <a href="{{ route('services') }}#{{ $service['slug'] }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-brand-50 hover:text-brand-600">
                            <x-icon :name="$service['icon'] ?? 'sparkles'" class="h-4 w-4 text-brand-500" />
                            {{ Site::t($service['title']) }}
                        </a>
                    @endforeach
                    <a href="{{ route('services') }}" class="rounded-lg px-3 py-2.5 text-sm font-bold text-brand-600 hover:bg-brand-50">{{ __('site.nav.solutions_all') }} ←</a>
                </div>
            </details>

            <a href="{{ route('portfolio') }}" class="rounded-lg px-4 py-3 text-base font-semibold {{ request()->routeIs('portfolio') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('site.nav.portfolio') }}</a>
            <a href="{{ route('contact') }}" class="rounded-lg px-4 py-3 text-base font-semibold {{ request()->routeIs('contact') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">{{ __('site.nav.contact') }}</a>

            <a href="{{ route('request') }}" class="btn-primary mt-2 w-full">{{ __('site.nav.request') }}</a>
        </div>
    </div>
</header>

{{-- Spacer for the fixed header --}}
<div class="h-18" aria-hidden="true"></div>
