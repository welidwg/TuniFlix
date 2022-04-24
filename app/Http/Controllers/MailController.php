<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class MailController extends Controller
{

    public function SendMail($email, $title, $body)
    {
        $details = [
            'title' => $title,
            'body' => $body
        ];
        Mail::to($email)->send(new Contact($details));
        return response("Mail Sent", 200);
    }
}
