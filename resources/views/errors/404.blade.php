<x-layouts.app :title="app()->getLocale() === 'ar' ? 'الصفحة غير موجودة' : 'Page not found'">
    <section class="flex min-h-[60vh] items-center justify-center py-20">
        <div class="container-x text-center">
            <p class="text-7xl font-extrabold text-gradient sm:text-8xl">404</p>
            <h1 class="mt-4 text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ app()->getLocale() === 'ar' ? 'عذراً، الصفحة غير موجودة' : 'Sorry, this page was not found' }}
            </h1>
            <p class="mx-auto mt-3 max-w-md text-slate-500">
                {{ app()->getLocale() === 'ar' ? 'الرابط الذي تبحث عنه قد يكون محذوفاً أو تم تغييره.' : 'The page you are looking for may have been moved or removed.' }}
            </p>
            <a href="{{ url('/' . app()->getLocale()) }}" class="btn-primary mt-8">
                {{ __('site.nav.home') }}
            </a>
        </div>
    </section>
</x-layouts.app>
