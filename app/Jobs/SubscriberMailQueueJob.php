<?php

namespace App\Jobs;

use App\Mail\SubscriberMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscriberMailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails = Subscriber::where('website_id', $this->post['website_id'])->pluck('email');;

        if (count($emails) < 0) return;

        $data = new SubscriberMail($this->post);

        foreach ($emails as $email) {
            Mail::to($email)->send($data);
        }
    }
}
