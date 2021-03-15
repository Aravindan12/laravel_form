<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $detail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        //
        $this->detail  = $detail;
        //  dd($this->detail);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $user_data1 = $this->detail;
        // dd($user_data1);

        
        $user1=array('email' => $user_data1['email']);
        // dd($user1);
        if($user1){
        
        Mail::send('forgotemail',$user1,function($message)use($user_data1) {
        $message->to($user_data1['email'])->subject('Testing Email');
        $message->from('rubanshanthi24@gmail.com', 'Testing App');
        
    });
}else{
    dd('poda');
}
    }
}
