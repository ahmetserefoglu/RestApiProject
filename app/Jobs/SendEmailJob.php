<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = 'ahmet.serefoglu46@gmail.com';
         $datax = ['ad' => 'asdas', 'mail' => 'ASDASD','token'=>'ASDASDASD','contact_number'=>'ASDASD'];
       
        Mail::send('mail', $datax, function($message) use ($email) {
         $message->to($email, 'SİteYonetimPaneli')->subject
            ('SİteYonetimPaneli');
         $message->from('ahmet@ahmetserefoglu.com','SiteYonetimi');
      });

        //Mail::to('ahmet.serefogl46@gmail.com')->send(new SendMailable());
    }
}
