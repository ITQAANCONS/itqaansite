<x-layouts.app :title="__('site.portfolio_page.title')" :description="__('site.portfolio_page.subtitle')">

    <x-page-hero :title="__('site.portfolio_page.title')" :subtitle="__('site.portfolio_page.subtitle')" :breadcrumb="__('site.nav.portfolio')" />

    <section class="py-20 sm:py-24">
        <div class="container-x">
            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $i => $project)
                    <x-project-card :project="$project" :delay="($i % 3) * 80" />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta />
</x-layouts.app>
