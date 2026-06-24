<x-mail::message>
# رسالة تواصل جديدة

وصلتك رسالة جديدة من نموذج التواصل في الموقع.

<x-mail::panel>
**الاسم:** {{ $data['name'] }}
**البريد الإلكتروني:** {{ $data['email'] }}
@isset($data['phone']) @if($data['phone'])
**الهاتف:** {{ $data['phone'] }}
@endif @endisset
@isset($data['subject']) @if($data['subject'])
**الموضوع:** {{ $data['subject'] }}
@endif @endisset
</x-mail::panel>

**الرسالة:**

{{ $data['message'] }}

<x-mail::button :url="'mailto:' . $data['email']">
الرد على المرسِل
</x-mail::button>

شكراً،<br>
{{ config('app.name') }}
</x-mail::message>
