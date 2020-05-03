<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContactUS;
class SupportController extends Controller
{
    public function index()
    {   
        $user_requests = ContactUS::all();
        return view('auth.admin.pages.customer-request',compact('user_requests'));
    }

    public function show($detailId)
    {   
        $user_request = ContactUS::findOrFail($detailId);
        return view('auth.admin.pages.support-details',compact('user_request'));
    }

    public function messageUpdateStatus(Request $request)
    {
        $message = ContactUS::findOrFail($request->message_id);
        $message->status = $request->status;
        $message->save();

        return response()->json(['message' => 'Message status updated successfully.']);
    }
}
