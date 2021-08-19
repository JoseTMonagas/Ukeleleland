<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Mail\ConversationStarted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConversationController extends Controller
{
    /**
     * @param 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retorna la lista de las conversaciones de ese usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()->get();

        return view('chat')->with(compact('conversations'));
    }

    /**
     * Crea una nueva conversacion entre el Usuario y el Perfil Seleccionado
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($profileId)
    {
        $user0 = Auth::user();
        if (!isset($profileId)) {
            return redirect()->route('ukeprofe.index');
        }
        $user1 = \App\Profile::find($profileId)->user()->first();
        $convo = $user0->hasConversationsWith($user1);
        if (!$convo) {
            if (!$user0->premium && $user0->conversations()->count() >= 4) {
                $route = route('infoLimite');
                $msg = [
                    "title" => "Solo puedes tener 3 conversaciones a la vez",
                    "msg" => "Si quieres saber como tener acceso a mas conversaciones, ingresa <a href=\"$route\">aqui</a>",
                ];
                return redirect()->route('home')->with(compact('msg'));
            }
            $conversation = new Conversation;
            $conversation->name = $user0->name . ' - ' . $user1->name;
            $conversation->saveOrFail();

            $user0->addConversation($conversation);
            $user1->addConversation($conversation);

            Mail::to($user1)->send(new ConversationStarted($user0));
            Mail::to($user0)->send(new ConversationStarted($user1));

            return redirect()->route('chat.index');
        } else {
            return redirect()->route('chat.index', $convo);
        }
    }
}
