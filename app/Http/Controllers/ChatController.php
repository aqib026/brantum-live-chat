<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Session;
use App\Events\MsgReadEvent;
use Illuminate\Http\Request;
use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;

class ChatController extends Controller
{

    public function send(Session $session, Request $request)
    {

        $message = $session->messages()->create(['content' => $request->content]);

        $chat = $message->createForSend($session->id);

        $message->createForReceive($session->id, $request->to_user);
       
            broadcast(new PrivateChatEvent($message->content,'1', $chat));
       
        return response($chat->id, 200);
    }
    public function sendFile(Session $session, Request $request)
    {

        if (request()->has('file')) {

            $filename = request('file')->store('chat');
            $message = $session->messages()->create(['image' => $filename, 'content' => null]);
        }
        $chat = $message->createForSend($session->id);

        $message->createForReceive($session->id, $request->to_user);
        if (request()->has('file')) {
            broadcast(new PrivateChatEvent($message->image,'0', $chat));
        }
        return response([
           'file'=> $filename,
            'chat_id' => $chat->id
        ]);
    }

    public function chats(Session $session)
    {
        return ChatResource::collection($session->chats->where('user_id', auth()->id()));
    }

    public function read(Session $session)
    {
        $chats = $session->chats->where('read_at', null)->where('type', 0)->where('user_id', '!=', auth()->id());

        foreach ($chats as $chat) {
            $chat->update(['read_at' => Carbon::now()]);
            broadcast(new MsgReadEvent(new ChatResource($chat), $chat->session_id));
        }
    }

    public function clear(Session $session)
    {
        $session->deleteChats();
        $session->chats->count() == 0 ? $session->deleteMessages() : '';
        return response('cleared', 200);
    }
}
