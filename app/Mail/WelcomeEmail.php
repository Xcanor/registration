<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fname;
    
    public function __construct(User $user)
    {
        
        $this->fname = $user->first_name;

    }


    public function build()
    {
        return $this->view('emails.welcome');
    }
}
