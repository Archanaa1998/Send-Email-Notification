<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function showForm()
    {
        return view('email.notification');
    }

    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3',
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Dispatch the queued email job
        SendEmailJob::dispatch([
            'email' => $request->email,
            'subject' => 'Welcome ' . $request->username,
            'message' => 'Thank you for signing up!'
        ]);

        return back()->with('success', 'Form submitted successfully!');
    }
}
