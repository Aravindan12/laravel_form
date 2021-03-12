<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_data = $this->details;
        $users=array('email' => $user_data['email'],'name'=> $user_data['name'],'password'=>$user_data['password']);
        Mail::send('email',$users,function($message)use($user_data) {
        $message->to($user_data['email'],$user_data['name'])->subject('Testing Email');
        $message->from('rubanshanthi24@gmail.com', 'Testing App');
        });

    }
}
