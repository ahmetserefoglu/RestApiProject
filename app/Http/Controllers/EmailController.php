<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Mail;

class EmailController extends Controller
{
    //
    public function sendEmail()
    {
       $emailJob = (new SendEmailJob())->delay(Carbon::now()->addSeconds(3));
	   
	   dispatch($emailJob);
	   echo 'email sent';

    }
}
