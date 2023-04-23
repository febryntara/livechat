<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomChatController extends Controller
{
    public function openForC(RoomChat $room, Request $request)
    {
        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'messages' => $room->messages->map(function ($message, $index) use ($room) {
                $message->message = Message::SecureRead($room->customer->token_10, $room->department->token_16, $message->chipertext);
                $message->view = view(($message->sender == $room->customer->code ? 'fragments.chat_sender' : 'fragments.chat_receiver'), ['message' => $message->message])->render();
                return $message;
            }),
            'iam' => $room->customer,
            'he' => $room->department
        ];
        return view('pages.chat.index', $data);
    }
    public function openForCS(RoomChat $room, Request $request)
    {
        if ($room->status == "ready") {
            $room->status = 'active';
            $room->save();
        }

        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'messages' => $room->messages->map(function ($message, $index) use ($room) {
                $message->message = Message::SecureRead($room->customer->token_10, $room->department->token_16, $message->chipertext);
                $message->view = view(($message->sender == $room->department->code ? 'fragments.chat_sender' : 'fragments.chat_receiver'), ['message' => $message->message])->render();
                return $message;
            }),
            'iam' => $room->department,
            'he' => $room->customer,
        ];
        // return $data['messages'];
        return view('pages.chat.index', $data);
    }

    public function chatStack()
    {
        $department = auth()->user()->department;
        $data = [
            'title' => 'Chat Stack',
            'department' => $department,
            'rooms' => $department->rooms()->where('status', 'ready')->get()
        ];

        return view('pages.chat.chat_stack', $data);
    }

    private function MessageProcessor(Collection $messages)
    {
        // foreach
    }
}
