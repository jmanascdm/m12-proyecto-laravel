<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {

        /* Mail::send('mail.test', [], function($message) {
            $message->to("hiimdrakster@gmail.com", "Drakster")->subject('Test de correo');
        }); */

        return view('test', compact('captchas'));
    }
}
