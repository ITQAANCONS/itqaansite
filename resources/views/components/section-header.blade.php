@props([
    'badge' => null,
    'title' => '',
    'subtitle' => null,
    'center' => true,
    'light' => false,
])

<div class="reveal {{ $center ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl' }}">
    @if ($badge)
        <span class="badge-pill {{ $light ? '!bg-white/10 !text-brand-200' : '' }}">
            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
            {{ $badge }}
        </span>
    @endif
    <h2 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl {{ $light ? 'text-white' : 'text-slate-900' }}">
        {{ $title }}
    </h2>
    @if ($subtitle)
        <p class="mt-4 text-base leading-relaxed {{ $light ? 'text-slate-300' : 'text-slate-500' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
