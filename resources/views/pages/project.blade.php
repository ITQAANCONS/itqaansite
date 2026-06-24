@php
    use App\Support\Site;
    $title = Site::t($project['title']);
    $category = Site::t($project['category']);
    $excerpt = Site::t($project['excerpt']);
    $description = Site::t($project['description']);
    $hasUrl = !empty($project['url']) && $project['url'] !== '#';
@endphp

<x-layouts.app :title="$title" :description="$excerpt">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-brand-50/70 to-white">
        <div class="pointer-events-none absolute -top-20 end-10 h-72 w-72 rounded-full bg-brand-300/25 blur-3xl"></div>
        <div class="container-x relative py-14 sm:py-16">
            <nav class="flex items-center gap-2 text-sm text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-brand-600">{{ __('site.nav.home') }}</a>
                <span>/</span>
                <a href="{{ route('portfolio') }}" class="hover:text-brand-600">{{ __('site.nav.portfolio') }}</a>
                <span>/</span>
                <span class="font-semibold text-brand-600">{{ $title }}</span>
            </nav>
            <div class="mt-6 flex flex-wrap items-end justify-between gap-6">
                <div>
                    <span class="badge-pill"><span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>{{ $category }}</span>
                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">{{ $title }}</h1>
                    <p class="mt-3 max-w-2xl text-lg text-slate-500">{{ $excerpt }}</p>
                </div>
                @if ($hasUrl)
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="btn-primary">
                        <x-icon name="globe" class="h-5 w-5" />
                        {{ __('site.view_project') }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Body --}}
    <section class="py-16 sm:py-20">
        <div class="container-x grid gap-12 lg:grid-cols-3">
            {{-- Main --}}
            <div class="reveal lg:col-span-2">
                <div class="overflow-hidden rounded-3xl border border-slate-100 bg-gradient-to-br from-brand-50 to-brand-100 shadow-sm">
                    <img src="{{ asset($project['image']) }}" alt="{{ $title }}"
                         class="aspect-[16/10] w-full object-cover" loading="lazy"
                         onerror="this.closest('div').style.minHeight='320px'">
                </div>

                <h2 class="mt-10 text-2xl font-extrabold text-slate-900">{{ __('site.portfolio_page.about_project') }}</h2>
                <p class="mt-4 text-base leading-loose text-slate-600">{{ $description }}</p>
            </div>

            {{-- Sidebar --}}
            <aside class="reveal" data-delay="120">
                <div class="sticky top-24 card">
                    <h3 class="text-lg font-bold text-slate-900">{{ __('site.portfolio_page.project_info') }}</h3>
                    <dl class="mt-5 space-y-4 text-sm">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <dt class="font-semibold text-slate-500">{{ __('site.portfolio_page.client') }}</dt>
                            <dd class="font-bold text-slate-800">{{ Site::t($project['client']) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <dt class="font-semibold text-slate-500">{{ __('site.portfolio_page.category') }}</dt>
                            <dd class="font-bold text-slate-800">{{ $category }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <dt class="font-semibold text-slate-500">{{ __('site.portfolio_page.year') }}</dt>
                            <dd class="font-bold text-slate-800">{{ $project['year'] }}</dd>
                        </div>
                        @if ($hasUrl)
                            <div class="flex items-center justify-between">
                                <dt class="font-semibold text-slate-500">{{ __('site.portfolio_page.website') }}</dt>
                                <dd><a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="font-bold text-brand-600 hover:underline" dir="ltr">{{ preg_replace('#^https?://#', '', $project['url']) }}</a></dd>
                            </div>
                        @endif
                    </dl>

                    @if (!empty($project['services']))
                        <h4 class="mt-7 mb-3 text-sm font-bold text-slate-900">{{ __('site.portfolio_page.services_used') }}</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project['services'] as $slug)
                                @php $svc = Site::service($slug); @endphp
                                @if ($svc)
                                    <a href="{{ route('services') }}#{{ $slug }}" class="rounded-full bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 transition hover:bg-brand-100">
                                        {{ Site::t($svc['title']) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ route('request') }}" class="btn-primary mt-7 w-full">{{ __('site.nav.request') }}</a>
                </div>
            </aside>
        </div>
    </section>

    {{-- Other projects --}}
    @if (count($others))
        <section class="bg-slate-50/70 py-20">
            <div class="container-x">
                <h2 class="reveal text-2xl font-extrabold text-slate-900">{{ __('site.portfolio_page.other_projects') }}</h2>
                <div class="mt-8 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($others as $i => $other)
                        <x-project-card :project="$other" :delay="$i * 80" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
