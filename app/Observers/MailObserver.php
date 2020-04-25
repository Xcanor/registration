<?php

namespace App\Observers;
use App\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth;

class MailObserver
{   
    // Once the user is created he will recevie welcome mail message
        
    public function created(User $user)
    {   
        if(!(request()->is("admin*")))
        
        {
            $user_email = $user->email;
        
            Mail::to($user_email)->send(new WelcomeEmail($user));
        }

       
    }
}
