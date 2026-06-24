<section class="py-20 sm:py-24">
    <div class="container-x">
        <div class="reveal relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-700 via-brand-600 to-brand-400 px-8 py-16 text-center shadow-2xl shadow-brand-600/30 sm:px-16">
            <div class="pointer-events-none absolute -top-16 -start-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -end-10 h-72 w-72 rounded-full bg-brand-300/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl">
                    {{ __('site.cta_section.title') }}
                </h2>
                <p class="mt-4 text-lg leading-relaxed text-brand-50">
                    {{ __('site.cta_section.subtitle') }}
                </p>
                <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="{{ route('request') }}" class="btn-light w-full sm:w-auto">
                        {{ __('site.cta_section.button') }}
                        <x-icon name="arrow" class="h-5 w-5 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" />
                    </a>
                    <a href="{{ route('contact') }}" class="btn w-full border border-white/40 text-white hover:bg-white/10 sm:w-auto">
                        {{ __('site.nav.contact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
