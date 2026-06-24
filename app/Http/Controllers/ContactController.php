<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\ContactMessage;
use App\Services\TelegramNotifier;
use App\Support\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request, TelegramNotifier $telegram)
    {
        $data = $request->validated();
        unset($data['website']); // honeypot

        $message = ContactMessage::create($data);

        try {
            Mail::to(Settings::notificationEmail())->send(new ContactMail($data));
        } catch (\Throwable $e) {
            Log::error('Contact mail failed: ' . $e->getMessage());
        }

        $telegram->notifyContactMessage($message);

        return back()->with('success', __('site.contact_page.success'));
    }
}
