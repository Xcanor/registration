<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\ContactUS;

class SupportController extends Controller
{
    public function create()
    {
        return view('auth.user.pages.contact');
    }

    public function send(ContactFormRequest $request)
    {
        $message =  ContactUS::create($request->all());
        return redirect()->back()->with("success","Message sent successfully !");
    }

    
}
