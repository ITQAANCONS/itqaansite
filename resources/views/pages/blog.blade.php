<x-layouts.app :title="__('site.blog_page.title')" :description="__('site.blog_page.subtitle')">

    <x-page-hero :title="__('site.blog_page.title')" :subtitle="__('site.blog_page.subtitle')" :breadcrumb="__('site.nav.blog')" />

    <section class="py-16 sm:py-20">
        <div class="container-x">
            @if ($posts->count())
                <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $i => $post)
                        <x-post-card :post="$post" :delay="($i % 3) * 80" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-slate-200 py-20 text-center text-slate-400">
                    {{ __('site.blog_page.empty') }}
                </div>
            @endif
        </div>
    </section>

    <x-cta />
</x-layouts.app>
