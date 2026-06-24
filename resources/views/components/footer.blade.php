@php
    $contact = config('site.contact');
    $social = config('site.social');
    $services = array_slice(config('site.services'), 0, 6);
    $year = date('Y');
@endphp

<footer class="relative mt-24 overflow-hidden bg-brand-950 text-slate-300">
    <div class="pointer-events-none absolute -top-24 end-0 h-72 w-72 rounded-full bg-brand-500/20 blur-3xl"></div>

    <div class="container-x relative grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-4">
        {{-- Brand --}}
        <div class="lg:col-span-1">
            <x-logo variant="white" class="h-10" />
            <p class="mt-5 max-w-xs text-sm leading-relaxed text-slate-400">
                {{ __('site.footer.about') }}
            </p>
            <div class="mt-6 flex gap-3">
                @foreach (['twitter' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z',
                            'linkedin' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
                            'instagram' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z',
                            'github' => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12'] as $key => $path)
                    @if (!empty($social[$key]))
                        <a href="{{ $social[$key] }}" target="_blank" rel="noopener" aria-label="{{ $key }}"
                           class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-slate-300 transition hover:bg-brand-500 hover:text-white">
                            <svg class="h-4.5 w-4.5" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $path }}" /></svg>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Quick links --}}
        <div>
            <h3 class="mb-5 text-sm font-bold uppercase tracking-wide text-white">{{ __('site.footer.quick_links') }}</h3>
            <ul class="space-y-3 text-sm">
                @foreach (['home' => __('site.nav.home'), 'services' => __('site.nav.services'), 'portfolio' => __('site.nav.portfolio'), 'request' => __('site.nav.request'), 'contact' => __('site.nav.contact')] as $route => $label)
                    <li>
                        <a href="{{ route($route) }}" class="text-slate-400 transition hover:text-brand-300 hover:ps-1">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Services --}}
        <div>
            <h3 class="mb-5 text-sm font-bold uppercase tracking-wide text-white">{{ __('site.footer.our_services') }}</h3>
            <ul class="space-y-3 text-sm">
                @foreach ($services as $service)
                    <li>
                        <a href="{{ route('services') }}#{{ $service['slug'] }}" class="text-slate-400 transition hover:text-brand-300 hover:ps-1">
                            {{ \App\Support\Site::t($service['title']) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Contact --}}
        <div>
            <h3 class="mb-5 text-sm font-bold uppercase tracking-wide text-white">{{ __('site.footer.contact') }}</h3>
            <ul class="space-y-4 text-sm">
                <li class="flex items-center gap-3">
                    <x-icon name="mail" class="h-5 w-5 shrink-0 text-brand-400" />
                    <a href="mailto:{{ $contact['email'] }}" class="text-slate-400 transition hover:text-brand-300" dir="ltr">{{ $contact['email'] }}</a>
                </li>
                <li class="flex items-center gap-3">
                    <x-icon name="phone" class="h-5 w-5 shrink-0 text-brand-400" />
                    <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}" class="text-slate-400 transition hover:text-brand-300" dir="ltr">{{ $contact['phone'] }}</a>
                </li>
                <li class="flex items-start gap-3">
                    <x-icon name="pin" class="mt-0.5 h-5 w-5 shrink-0 text-brand-400" />
                    <span class="text-slate-400">{{ \App\Support\Site::t($contact['address']) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-x flex flex-col items-center justify-between gap-3 py-6 text-xs text-slate-500 sm:flex-row">
            <p>&copy; {{ $year }} {{ \App\Support\Site::t(config('site.company.name')) }}. {{ __('site.footer.rights') }}</p>
            <p class="flex items-center gap-1.5">{{ __('site.footer.made_with') }} <span class="text-brand-400">♥</span></p>
        </div>
    </div>
</footer>
