@php use App\Support\Site; use App\Support\Content; @endphp

<x-layouts.app>
    {{-- ============ HERO ============ --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-brand-50/60 to-white">
        {{-- Decorative blobs --}}
        <div class="pointer-events-none absolute -top-24 start-1/4 h-96 w-96 rounded-full bg-brand-300/30 blur-3xl animate-blob"></div>
        <div class="pointer-events-none absolute top-20 end-0 h-80 w-80 rounded-full bg-brand-400/20 blur-3xl animate-blob" style="animation-delay:-5s"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(#226b9f 1px,transparent 1px);background-size:28px 28px"></div>

        <div class="container-x relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2 lg:py-28">
            <div class="text-center lg:text-start">
                <span class="badge-pill animate-fade-in">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                    {{ Content::get('home_hero_badge', __('site.hero.badge')) }}
                </span>
                <h1 class="mt-6 text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl animate-fade-up">
                    {{ Content::get('home_hero_title', __('site.hero.title')) }}
                    <span class="text-gradient">{{ Content::get('home_hero_highlight', __('site.hero.title_highlight')) }}</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-500 lg:mx-0 mx-auto animate-fade-up" style="animation-delay:.1s">
                    {{ Content::get('home_hero_subtitle', __('site.hero.subtitle')) }}
                </p>
                <div class="mt-9 flex flex-col items-center gap-3 sm:flex-row lg:justify-start justify-center animate-fade-up" style="animation-delay:.2s">
                    <a href="{{ route('request') }}" class="btn-primary w-full sm:w-auto">
                        {{ __('site.hero.cta_primary') }}
                        <x-icon name="arrow" class="h-5 w-5 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
                    </a>
                    <a href="{{ route('portfolio') }}" class="btn-outline w-full sm:w-auto">
                        {{ __('site.hero.cta_secondary') }}
                    </a>
                </div>
            </div>

            {{-- Hero visual --}}
            <div class="relative animate-fade-up" style="animation-delay:.15s">
                <div class="relative mx-auto max-w-md">
                    <div class="absolute inset-0 -rotate-6 rounded-[2rem] bg-gradient-to-br from-brand-600 to-brand-400 opacity-90"></div>
                    <div class="relative rounded-[2rem] border border-white/40 bg-white/80 p-8 shadow-2xl shadow-brand-600/20 backdrop-blur animate-float">
                        <x-logo class="h-12" />
                        <div class="mt-7 space-y-4">
                            @foreach ([__('site.about.point_1'), __('site.about.point_2'), __('site.about.point_3'), __('site.about.point_4')] as $point)
                                <div class="flex items-center gap-3 rounded-xl bg-brand-50/70 px-4 py-3">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-brand-600 text-white">
                                        <x-icon name="check" class="h-4 w-4" />
                                    </span>
                                    <span class="text-sm font-semibold text-slate-700">{{ $point }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ STATS ============ --}}
    <section class="border-y border-slate-100 bg-white">
        <div class="container-x grid grid-cols-2 gap-6 py-12 lg:grid-cols-4">
            @foreach ($stats as $i => $stat)
                <div class="reveal text-center" data-delay="{{ $i * 80 }}">
                    <div class="text-4xl font-extrabold text-gradient sm:text-5xl" data-counter="{{ $stat['value'] }}">{{ $stat['value'] }}</div>
                    <div class="mt-2 text-sm font-medium text-slate-500">{{ Site::t($stat['label']) }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ ABOUT ============ --}}
    <section class="py-20 sm:py-28">
        <div class="container-x grid items-center gap-14 lg:grid-cols-2">
            <div class="reveal relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="rounded-2xl bg-gradient-to-br from-brand-600 to-brand-400 p-7 text-white shadow-lg shadow-brand-600/20">
                            <x-icon name="rocket" class="h-9 w-9" />
                            <p class="mt-4 text-3xl font-extrabold">+120</p>
                            <p class="text-sm text-brand-50">{{ Site::t(['ar' => 'مشروع ناجح', 'en' => 'Successful projects']) }}</p>
                        </div>
                        <div class="card">
                            <x-icon name="users" class="h-9 w-9 text-brand-500" />
                            <p class="mt-4 text-3xl font-extrabold text-slate-900">+80</p>
                            <p class="text-sm text-slate-500">{{ Site::t(['ar' => 'عميل يثق بنا', 'en' => 'Clients trust us']) }}</p>
                        </div>
                    </div>
                    <div class="mt-8 space-y-4">
                        <div class="card">
                            <x-icon name="shield" class="h-9 w-9 text-brand-500" />
                            <p class="mt-4 text-3xl font-extrabold text-slate-900">100%</p>
                            <p class="text-sm text-slate-500">{{ Site::t(['ar' => 'التزام بالجودة', 'en' => 'Quality commitment']) }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-900 p-7 text-white">
                            <x-icon name="clock" class="h-9 w-9 text-brand-400" />
                            <p class="mt-4 text-3xl font-extrabold">24/7</p>
                            <p class="text-sm text-slate-400">{{ Site::t(['ar' => 'دعم متواصل', 'en' => 'Ongoing support']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal">
                <span class="badge-pill"><span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>{{ __('site.about.badge') }}</span>
                <h2 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-4xl">{{ Content::get('home_about_title', __('site.about.title')) }}</h2>
                <p class="mt-5 text-base leading-relaxed text-slate-500">{{ Content::get('home_about_body', __('site.about.body')) }}</p>
                <div class="mt-7 grid gap-3 sm:grid-cols-2">
                    @foreach ([__('site.about.point_1'), __('site.about.point_2'), __('site.about.point_3'), __('site.about.point_4')] as $point)
                        <div class="flex items-center gap-3">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-100 text-brand-600">
                                <x-icon name="check" class="h-4 w-4" />
                            </span>
                            <span class="text-sm font-semibold text-slate-700">{{ $point }}</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('services') }}" class="btn-primary mt-9">
                    {{ __('site.learn_more') }}
                    <x-icon name="arrow" class="h-5 w-5 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
                </a>
            </div>
        </div>
    </section>

    {{-- ============ SERVICES ============ --}}
    <section class="bg-slate-50/70 py-20 sm:py-28">
        <div class="container-x">
            <x-section-header
                :badge="__('site.services_section.badge')"
                :title="__('site.services_section.title')"
                :subtitle="__('site.services_section.subtitle')" />

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $service)
                    <x-service-card :service="$service" :delay="$i * 70" />
                @endforeach
            </div>

            <div class="reveal mt-12 text-center">
                <a href="{{ route('services') }}" class="btn-outline">
                    {{ __('site.nav.services') }}
                    <x-icon name="arrow" class="h-5 w-5 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
                </a>
            </div>
        </div>
    </section>

    {{-- ============ PROCESS ============ --}}
    <section class="py-20 sm:py-28">
        <div class="container-x">
            <x-section-header
                :badge="__('site.process_section.badge')"
                :title="__('site.process_section.title')"
                :subtitle="__('site.process_section.subtitle')" />

            <div class="relative mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($process as $i => $step)
                    <div class="reveal relative text-center" data-delay="{{ $i * 90 }}">
                        <div class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-lg shadow-brand-600/10 ring-1 ring-slate-100">
                            <x-icon :name="$step['icon']" class="h-9 w-9 text-brand-600" />
                            <span class="absolute -top-2 -end-2 flex h-7 w-7 items-center justify-center rounded-full bg-brand-600 text-xs font-bold text-white">{{ $i + 1 }}</span>
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-slate-900">{{ Site::t($step['title']) }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ Site::t($step['desc']) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ PORTFOLIO ============ --}}
    <section class="bg-slate-50/70 py-20 sm:py-28">
        <div class="container-x">
            <x-section-header
                :badge="__('site.portfolio_section.badge')"
                :title="__('site.portfolio_section.title')"
                :subtitle="__('site.portfolio_section.subtitle')" />

            <div class="mt-14 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $i => $project)
                    <x-project-card :project="$project" :delay="$i * 80" />
                @endforeach
            </div>

            <div class="reveal mt-12 text-center">
                <a href="{{ route('portfolio') }}" class="btn-outline">
                    {{ __('site.nav.portfolio') }}
                    <x-icon name="arrow" class="h-5 w-5 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
                </a>
            </div>
        </div>
    </section>

    {{-- ============ CTA ============ --}}
    <x-cta />
</x-layouts.app>
