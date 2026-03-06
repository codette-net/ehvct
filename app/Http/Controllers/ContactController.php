<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');

    }

    public function submit(Request $request) {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'phone' => ['nullable','string','max:40'],
            'email' => ['required', 'email'],
            'subject' => ['nullable','string','max:120'],
            'message' => ['required','string','max:2000'],
            'company' => ['nullable','max:0']
        ]);

        Mail::to(config('mail.admin_notify') ?: env('ADMIN_NOTIFY_EMAIL'))
            ->send(new ContactMail($data));

        return back()->with('success', 'Your message has been sent. We will get back to you as soon as possible.');
    }

}
