<x-layouts.app :title="__('site.services_page.title')" :description="__('site.services_page.subtitle')">

    <x-page-hero :title="__('site.services_page.title')" :subtitle="__('site.services_page.subtitle')" :breadcrumb="__('site.nav.services')" />

    <section class="py-20 sm:py-24">
        <div class="container-x">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $service)
                    <x-service-card :service="$service" :detailed="true" :delay="($i % 3) * 80" />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta />
</x-layouts.app>
