<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class ContactController extends Controller
{
    public function show()
    {
        return view('extras.contactanos');
    }

    public function contact(Request $request)
    {
        $from = $request->input('email');
        $name = $request->input('name') . ' ' . $request->input('surname');
        $message = $request->input('message');
        Mail::to('aloha@ukelelelandbrand.cl')->send(new ContactForm($from, $name, $message));

        $msg = [
            'icon' => 'success',
            'title' => '¡Mensaje enviado!',
            'msg' => 'Gracias por tu atencion'
        ];

        return redirect()->route('home')->with(compact('msg'));
    }
}
