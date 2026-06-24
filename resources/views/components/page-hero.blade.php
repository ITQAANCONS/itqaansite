@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => null,
])

<section class="relative overflow-hidden bg-gradient-to-b from-brand-50/70 to-white">
    <div class="pointer-events-none absolute -top-20 end-10 h-72 w-72 rounded-full bg-brand-300/25 blur-3xl"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(#226b9f 1px,transparent 1px);background-size:28px 28px"></div>

    <div class="container-x relative py-16 text-center sm:py-20">
        <nav class="flex items-center justify-center gap-2 text-sm text-slate-400 animate-fade-in">
            <a href="{{ route('home') }}" class="hover:text-brand-600">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <span class="font-semibold text-brand-600">{{ $breadcrumb ?? $title }}</span>
        </nav>
        <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl animate-fade-up">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-slate-500 animate-fade-up" style="animation-delay:.1s">{{ $subtitle }}</p>
        @endif
    </div>
</section>
