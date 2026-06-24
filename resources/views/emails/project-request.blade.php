@php
    $typeLabel = \App\Support\Site::t(config('site.request_options.project_types.' . ($data['project_type'] ?? '')) ?? '');
    $budgetLabel = !empty($data['budget']) ? \App\Support\Site::t(config('site.request_options.budgets.' . $data['budget']) ?? '') : '—';
    $timelineLabel = !empty($data['timeline']) ? \App\Support\Site::t(config('site.request_options.timelines.' . $data['timeline']) ?? '') : '—';
    $serviceLabels = collect($data['services'] ?? [])->map(function ($slug) {
        $svc = \App\Support\Site::service($slug);
        return $svc ? \App\Support\Site::t($svc['title']) : $slug;
    })->all();
    $brand = ($data['has_brand'] ?? '') === 'yes' ? 'نعم' : (($data['has_brand'] ?? '') === 'no' ? 'لا' : '—');
@endphp

<x-mail::message>
# 🚀 طلب مشروع جديد

تم تقديم طلب مشروع جديد عبر الموقع. التفاصيل أدناه:

<x-mail::panel>
**الاسم:** {{ $data['name'] }}
**البريد الإلكتروني:** {{ $data['email'] }}
**رقم الجوال:** {{ $data['phone'] }}
@if(!empty($data['company']))
**الجهة:** {{ $data['company'] }}
@endif
</x-mail::panel>

<x-mail::table>
| البند | القيمة |
| :--- | :--- |
| نوع المشروع | {{ $typeLabel ?: '—' }} |
| الخدمات المطلوبة | {{ count($serviceLabels) ? implode('، ', $serviceLabels) : '—' }} |
| الميزانية التقديرية | {{ $budgetLabel ?: '—' }} |
| الإطار الزمني | {{ $timelineLabel ?: '—' }} |
| لديه هوية بصرية؟ | {{ $brand }} |
</x-mail::table>

**وصف المشروع:**

{{ $data['description'] }}

<x-mail::button :url="'mailto:' . $data['email']">
التواصل مع العميل
</x-mail::button>

{{ config('app.name') }}
</x-mail::message>
