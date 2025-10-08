<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        try {
            $data = $request->only([
                'full_name',
                'email',
                'phone',
                'subject',
                'message'
            ]);

            Mail::to('contact@sos-environnement.mr')->queue(new ContactMessageMail($data));

            return back()->with('success', __('app/contact.success_send_message', [
                'name' => $data['full_name'],
            ]));
        } catch (\Throwable $e) {
            return back()->with('error', __('app/contact.error_send_message'));
        }
    }
}
