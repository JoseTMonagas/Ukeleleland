<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conversation = null)
    {
        $user = Auth::user();
        $conversations = $user->conversations()->get();
        if (isset($conversation)) {
            $conversation = \App\Conversation::find($conversation);
            $receptor = $conversation->users()->where('user_id', '!=', $user->id)->first();
        } else {
            $receptor = null;
        }

        return view('chat')->with(compact('conversations', 'conversation', 'receptor'));
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($conversationId)
    {
        $convo = \App\Conversation::find($conversationId);
        return $convo->messages()->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage($conversationId, Request $request)
    {
        $user = Auth::user();
        $message = $request->get('message');
        $message = Message::create([
            'message' => $message,
            'user_id' => $user->id,
            'conversation_id' => $conversationId
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json([
            'msg' => 'Mensaje enviado'
        ], Response::HTTP_CREATED);   
    }
}
