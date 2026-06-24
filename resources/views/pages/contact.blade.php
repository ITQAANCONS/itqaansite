@php $contact = config('site.contact'); @endphp

<x-layouts.app :title="__('site.contact_page.title')" :description="__('site.contact_page.subtitle')">

    <x-page-hero :title="__('site.contact_page.title')" :subtitle="__('site.contact_page.subtitle')" :breadcrumb="__('site.nav.contact')" />

    <section class="py-16 sm:py-20">
        <div class="container-x grid gap-10 lg:grid-cols-5">
            {{-- Form --}}
            <div class="reveal lg:col-span-3">
                <div class="card sm:p-9">
                    @if (session('success'))
                        <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">
                            <x-icon name="check" class="mt-0.5 h-5 w-5 shrink-0" />
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="field-label">{{ __('site.contact_page.form_name') }} <span class="text-red-500">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}" class="field-input" autocomplete="name">
                            </div>
                            <div>
                                <label for="email" class="field-label">{{ __('site.contact_page.form_email') }} <span class="text-red-500">*</span></label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}" class="field-input" dir="ltr" autocomplete="email">
                            </div>
                            <div>
                                <label for="phone" class="field-label">{{ __('site.contact_page.form_phone') }}</label>
                                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="field-input" dir="ltr" autocomplete="tel">
                            </div>
                            <div>
                                <label for="subject" class="field-label">{{ __('site.contact_page.form_subject') }}</label>
                                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" class="field-input">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="field-label">{{ __('site.contact_page.form_message') }} <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" required class="field-input resize-none">{{ old('message') }}</textarea>
                        </div>
                        {{-- Honeypot --}}
                        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            <x-icon name="mail" class="h-5 w-5" />
                            {{ __('site.contact_page.form_submit') }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="reveal lg:col-span-2" data-delay="120">
                <div class="rounded-2xl bg-gradient-to-br from-brand-700 to-brand-500 p-8 text-white shadow-lg shadow-brand-600/20">
                    <h3 class="text-xl font-bold">{{ __('site.contact_page.info_title') }}</h3>
                    <ul class="mt-7 space-y-6">
                        <li class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/15"><x-icon name="mail" class="h-5 w-5" /></span>
                            <div>
                                <p class="text-sm text-brand-100">{{ __('site.contact_page.email') }}</p>
                                <a href="mailto:{{ $contact['email'] }}" class="font-semibold hover:underline" dir="ltr">{{ $contact['email'] }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/15"><x-icon name="phone" class="h-5 w-5" /></span>
                            <div>
                                <p class="text-sm text-brand-100">{{ __('site.contact_page.phone') }}</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}" class="font-semibold hover:underline" dir="ltr">{{ $contact['phone'] }}</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/15"><x-icon name="pin" class="h-5 w-5" /></span>
                            <div>
                                <p class="text-sm text-brand-100">{{ __('site.contact_page.address') }}</p>
                                <p class="font-semibold">{{ \App\Support\Site::t($contact['address']) }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Map --}}
                <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100 shadow-sm">
                    <iframe
                        title="Map"
                        src="https://www.google.com/maps?q={{ urlencode($contact['map_query']) }}&output=embed"
                        width="100%" height="260" style="border:0" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
