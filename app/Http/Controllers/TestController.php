<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Repositories\CaptchasRepository;

class TestController extends Controller
{
    public function index()
    {
        $captchas = new CaptchasRepository('demo', 'secret','/tmp/captchasnet-random-strings','3600','abcdefghkmnopqrstuvwxyz','6','240','80','000088');

        /* Mail::send('mail.test', [], function($message) {
            $message->to("hiimdrakster@gmail.com", "Drakster")->subject('Test de correo');
        }); */

        return view('test', compact('captchas'));
    }
}
