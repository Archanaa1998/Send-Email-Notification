<?php

namespace App\Jobs;

use App\Mail\SendNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    public $tries = 3;       // Number of retry attempts
    public $backoff = 10;    // Wait 10 seconds before retry

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        Mail::to($this->details['email'])->send(new SendNotificationMail($this->details));
    }

    public function failed(\Throwable $exception)
    {
        // Log the error message
        \Log::error('SendEmailJob Failed: ' . $exception->getMessage());
    }
}
