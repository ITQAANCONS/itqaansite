@php use App\Support\Site; @endphp

<x-layouts.app :title="__('site.request_page.title')" :description="__('site.request_page.subtitle')">

    <x-page-hero :title="__('site.request_page.title')" :subtitle="__('site.request_page.subtitle')" :breadcrumb="__('site.nav.request')" />

    <section class="py-14 sm:py-20">
        <div class="container-x max-w-3xl">

            @if (session('success'))
                <div class="reveal rounded-3xl border border-green-200 bg-green-50 p-10 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-white">
                        <x-icon name="check" class="h-8 w-8" />
                    </div>
                    <h2 class="mt-6 text-2xl font-extrabold text-slate-900">{{ __('site.request_page.success') }}</h2>
                    <a href="{{ route('home') }}" class="btn-primary mt-8">{{ __('site.nav.home') }}</a>
                </div>
            @else

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('request.store') }}" data-wizard class="card sm:p-9">
                    @csrf

                    {{-- Progress --}}
                    <div class="mb-9">
                        <div class="flex items-center justify-between text-sm font-semibold text-slate-500">
                            <span>{{ __('site.request_page.step') }} <span data-current-step>1</span> {{ __('site.request_page.of') }} 4</span>
                            <div class="flex gap-2">
                                @for ($s = 0; $s < 4; $s++)
                                    <span data-step-dot class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold transition-all {{ $s === 0 ? 'bg-brand-600 text-white' : 'bg-slate-100 text-slate-400' }}">{{ $s + 1 }}</span>
                                @endfor
                            </div>
                        </div>
                        <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-100">
                            <div data-progress-bar class="h-full rounded-full bg-gradient-to-l from-brand-600 to-brand-400 transition-all duration-500" style="width:25%"></div>
                        </div>
                    </div>

                    {{-- ===== STEP 1: Your details ===== --}}
                    <div data-step>
                        <h2 class="text-xl font-bold text-slate-900">{{ __('site.request_page.step1_title') }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ __('site.request_page.step1_desc') }}</p>

                        <div class="mt-6 grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="field-label">{{ __('site.request_page.name') }} <span class="text-red-500">*</span></label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}" class="field-input" autocomplete="name">
                            </div>
                            <div>
                                <label for="email" class="field-label">{{ __('site.request_page.email') }} <span class="text-red-500">*</span></label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}" class="field-input" dir="ltr" autocomplete="email">
                            </div>
                            <div>
                                <label for="phone" class="field-label">{{ __('site.request_page.phone') }} <span class="text-red-500">*</span></label>
                                <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}" class="field-input" dir="ltr" autocomplete="tel">
                            </div>
                            <div>
                                <label for="company" class="field-label">{{ __('site.request_page.company') }}</label>
                                <input id="company" name="company" type="text" value="{{ old('company') }}" class="field-input">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="button" data-next class="btn-primary">{{ __('site.request_page.next') }}<x-icon name="arrow" class="h-5 w-5 {{ $locale === 'ar' ? 'rotate-180' : '' }}" /></button>
                        </div>
                    </div>

                    {{-- ===== STEP 2: Project type ===== --}}
                    <div data-step class="hidden">
                        <h2 class="text-xl font-bold text-slate-900">{{ __('site.request_page.step2_title') }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ __('site.request_page.step2_desc') }}</p>

                        <label class="field-label mt-6">{{ __('site.request_page.project_type') }} <span class="text-red-500">*</span></label>
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach ($types as $key => $label)
                                <label class="group flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3.5 transition has-[:checked]:border-brand-400 has-[:checked]:bg-brand-50 has-[:checked]:ring-2 has-[:checked]:ring-brand-400/30">
                                    <input type="radio" name="project_type" value="{{ $key }}" required data-label="{{ Site::t($label) }}"
                                           {{ old('project_type') === $key ? 'checked' : '' }}
                                           class="h-4 w-4 accent-brand-600">
                                    <span class="text-sm font-semibold text-slate-700">{{ Site::t($label) }}</span>
                                </label>
                            @endforeach
                        </div>

                        <label class="field-label mt-7">{{ __('site.request_page.services') }}</label>
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach ($services as $service)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 transition has-[:checked]:border-brand-400 has-[:checked]:bg-brand-50">
                                    <input type="checkbox" name="services[]" value="{{ $service['slug'] }}" data-label="{{ Site::t($service['title']) }}"
                                           {{ in_array($service['slug'], old('services', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded accent-brand-600">
                                    <span class="text-sm font-medium text-slate-700">{{ Site::t($service['title']) }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button type="button" data-prev class="btn-ghost">{{ __('site.request_page.prev') }}</button>
                            <button type="button" data-next class="btn-primary">{{ __('site.request_page.next') }}<x-icon name="arrow" class="h-5 w-5 {{ $locale === 'ar' ? 'rotate-180' : '' }}" /></button>
                        </div>
                    </div>

                    {{-- ===== STEP 3: Details ===== --}}
                    <div data-step class="hidden">
                        <h2 class="text-xl font-bold text-slate-900">{{ __('site.request_page.step3_title') }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ __('site.request_page.step3_desc') }}</p>

                        <div class="mt-6 space-y-5">
                            <div>
                                <label for="description" class="field-label">{{ __('site.request_page.description') }} <span class="text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="5" required placeholder="{{ __('site.request_page.description_ph') }}" class="field-input resize-none">{{ old('description') }}</textarea>
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="budget" class="field-label">{{ __('site.request_page.budget') }}</label>
                                    <select id="budget" name="budget" class="field-input" data-label-select>
                                        <option value="">{{ __('site.request_page.select') }}</option>
                                        @foreach ($budgets as $key => $label)
                                            <option value="{{ $key }}" data-label="{{ Site::t($label) }}" {{ old('budget') === $key ? 'selected' : '' }}>{{ Site::t($label) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="timeline" class="field-label">{{ __('site.request_page.timeline') }}</label>
                                    <select id="timeline" name="timeline" class="field-input">
                                        <option value="">{{ __('site.request_page.select') }}</option>
                                        @foreach ($timelines as $key => $label)
                                            <option value="{{ $key }}" {{ old('timeline') === $key ? 'selected' : '' }}>{{ Site::t($label) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="field-label">{{ __('site.request_page.has_brand') }}</label>
                                <div class="flex gap-3">
                                    @foreach (['yes' => __('site.request_page.yes'), 'no' => __('site.request_page.no')] as $key => $label)
                                        <label class="flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3 transition has-[:checked]:border-brand-400 has-[:checked]:bg-brand-50">
                                            <input type="radio" name="has_brand" value="{{ $key }}" data-label="{{ $label }}" {{ old('has_brand') === $key ? 'checked' : '' }} class="h-4 w-4 accent-brand-600">
                                            <span class="text-sm font-semibold text-slate-700">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button type="button" data-prev class="btn-ghost">{{ __('site.request_page.prev') }}</button>
                            <button type="button" data-next class="btn-primary">{{ __('site.request_page.next') }}<x-icon name="arrow" class="h-5 w-5 {{ $locale === 'ar' ? 'rotate-180' : '' }}" /></button>
                        </div>
                    </div>

                    {{-- ===== STEP 4: Review ===== --}}
                    <div data-step class="hidden">
                        <h2 class="text-xl font-bold text-slate-900">{{ __('site.request_page.step4_title') }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ __('site.request_page.review_note') }}</p>

                        <dl class="mt-6 divide-y divide-slate-100 rounded-2xl border border-slate-100 bg-slate-50/50 px-5">
                            @foreach ([
                                'name' => __('site.request_page.name'),
                                'email' => __('site.request_page.email'),
                                'phone' => __('site.request_page.phone'),
                                'company' => __('site.request_page.company'),
                                'project_type' => __('site.request_page.project_type'),
                                'services' => __('site.request_page.services'),
                                'description' => __('site.request_page.description'),
                                'budget' => __('site.request_page.budget'),
                                'timeline' => __('site.request_page.timeline'),
                                'has_brand' => __('site.request_page.has_brand'),
                            ] as $field => $label)
                                <div class="flex flex-col gap-1 py-3.5 sm:flex-row sm:items-start sm:justify-between sm:gap-6">
                                    <dt class="text-sm font-semibold text-slate-500">{{ $label }}</dt>
                                    <dd class="text-sm font-semibold text-slate-800 sm:text-end" data-review="{{ $field }}" data-empty="{{ __('site.request_page.not_specified') }}">—</dd>
                                </div>
                            @endforeach
                        </dl>

                        {{-- Honeypot --}}
                        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                        <div class="mt-8 flex justify-between">
                            <button type="button" data-prev class="btn-ghost">{{ __('site.request_page.prev') }}</button>
                            <button type="submit" class="btn-primary">
                                <x-icon name="rocket" class="h-5 w-5" />
                                {{ __('site.request_page.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </section>
</x-layouts.app>
