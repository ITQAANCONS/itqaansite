<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:120'],
            'email'        => ['required', 'email', 'max:180'],
            'phone'        => ['required', 'string', 'max:40'],
            'company'      => ['nullable', 'string', 'max:160'],
            'project_type' => ['required', Rule::in(array_keys(config('site.request_options.project_types')))],
            'services'     => ['nullable', 'array'],
            'services.*'   => ['string', 'max:60'],
            'description'  => ['required', 'string', 'max:5000'],
            'budget'       => ['nullable', Rule::in(array_keys(config('site.request_options.budgets')))],
            'timeline'     => ['nullable', Rule::in(array_keys(config('site.request_options.timelines')))],
            'has_brand'    => ['nullable', Rule::in(['yes', 'no'])],
            // Honeypot — must stay empty.
            'website'      => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return __('site.fields');
    }
}
