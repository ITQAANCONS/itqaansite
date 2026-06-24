<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequestRequest;
use App\Mail\ProjectRequestMail;
use App\Support\Site;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProjectRequestController extends Controller
{
    public function create()
    {
        return view('pages.request', [
            'services'  => Site::services(),
            'types'     => config('site.request_options.project_types'),
            'budgets'   => config('site.request_options.budgets'),
            'timelines' => config('site.request_options.timelines'),
        ]);
    }

    public function store(ProjectRequestRequest $request)
    {
        $data = $request->validated();

        try {
            Mail::to(config('site.contact.email'))->send(new ProjectRequestMail($data));
        } catch (\Throwable $e) {
            Log::error('Project request mail failed: ' . $e->getMessage());
        }

        return back()->with('success', __('site.request_page.success'));
    }
}
