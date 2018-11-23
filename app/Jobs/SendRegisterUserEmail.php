<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendRegisterUserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $data;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->data = compact('user');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $view = 'emails.confirm';
        //$data = compact('user');
        $to   = $this->user->email;
        $subject = "感谢注册 SanMu 应用！请确认你的邮箱。";

        Mail::send($view, $this->data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
