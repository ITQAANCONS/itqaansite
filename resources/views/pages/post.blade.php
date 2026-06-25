<x-layouts.app :title="$post->title" :description="$post->excerpt">

    {{-- Header --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-brand-50/70 to-white">
        <div class="pointer-events-none absolute -top-20 end-10 h-72 w-72 rounded-full bg-brand-300/25 blur-3xl"></div>
        <div class="container-x relative max-w-3xl py-14 sm:py-16">
            <nav class="flex items-center gap-2 text-sm text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-brand-600">{{ __('site.nav.home') }}</a>
                <span>/</span>
                <a href="{{ route('blog') }}" class="hover:text-brand-600">{{ __('site.nav.blog') }}</a>
            </nav>
            @if ($post->category)
                <span class="badge-pill mt-6"><span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>{{ $post->category }}</span>
            @endif
            <h1 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-4xl">{{ $post->title }}</h1>
            <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-slate-500">
                @if ($post->author)<span>{{ __('site.blog_page.by') }} <span class="font-semibold text-slate-700">{{ $post->author }}</span></span>@endif
                <span>{{ optional($post->published_at)->translatedFormat('d MMMM Y') }}</span>
                <span>{{ $post->reading_time }} {{ __('site.blog_page.reading_time') }}</span>
            </div>
        </div>
    </section>

    {{-- Body --}}
    <article class="py-12 sm:py-16">
        <div class="container-x max-w-3xl">
            @if ($post->cover_url)
                <img src="{{ $post->cover_url }}" alt="{{ $post->title }}"
                     class="reveal mb-10 aspect-[16/9] w-full rounded-3xl object-cover shadow-sm" loading="lazy">
            @endif

            <div class="post-body reveal">
                {!! $post->body !!}
            </div>

            <div class="mt-12 flex items-center justify-between border-t border-slate-100 pt-6">
                <a href="{{ route('blog') }}" class="btn-ghost">
                    <x-icon name="arrow" class="h-4 w-4 {{ app()->getLocale() === 'ar' ? '' : 'rotate-180' }}" />
                    {{ __('site.blog_page.back') }}
                </a>
            </div>
        </div>
    </article>

    {{-- Related --}}
    @if ($related->count())
        <section class="bg-slate-50/70 py-16">
            <div class="container-x">
                <h2 class="reveal text-2xl font-extrabold text-slate-900">{{ __('site.blog_page.related') }}</h2>
                <div class="mt-8 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $i => $item)
                        <x-post-card :post="$item" :delay="$i * 80" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
