<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        try {
            Mail::to(config('site.contact.email'))->send(new ContactMail($data));
        } catch (\Throwable $e) {
            // Don't break the UX if SMTP isn't configured yet — log it.
            Log::error('Contact mail failed: ' . $e->getMessage());
        }

        return back()->with('success', __('site.contact_page.success'));
    }
}
