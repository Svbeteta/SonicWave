<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $userEmail = Auth::user()->email;

        Mail::to($userEmail)->send(new ContactMail($request->name, $request->email, $request->message));

        return back()->with('success', 'Mensaje enviado con éxito.');
    }
}
