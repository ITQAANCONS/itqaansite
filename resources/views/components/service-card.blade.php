@props([
    'service' => [],
    'detailed' => false,
    'delay' => 0,
])

@php
    use App\Support\Site;
    $title = Site::t($service['title'] ?? '');
    $excerpt = Site::t($service['excerpt'] ?? '');
    $features = $service['features'][app()->getLocale()] ?? ($service['features']['ar'] ?? []);
@endphp

<div id="{{ $service['slug'] ?? '' }}"
     class="reveal card card-hover group scroll-mt-28" data-delay="{{ $delay }}">
    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-50 to-brand-100 text-brand-600 transition-all duration-300 group-hover:from-brand-600 group-hover:to-brand-400 group-hover:text-white">
        <x-icon :name="$service['icon'] ?? 'sparkles'" class="h-7 w-7" />
    </div>

    <h3 class="mt-5 text-lg font-bold text-slate-900">{{ $title }}</h3>
    <p class="mt-2.5 text-sm leading-relaxed text-slate-500">{{ $excerpt }}</p>

    @if ($detailed && count($features))
        <ul class="mt-5 space-y-2.5 border-t border-slate-100 pt-5">
            @foreach ($features as $feature)
                <li class="flex items-start gap-2.5 text-sm text-slate-600">
                    <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-brand-500" />
                    <span>{{ $feature }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
