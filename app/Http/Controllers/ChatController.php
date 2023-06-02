<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Message;
use App\Models\MessageEncryption;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // return response()->json($request->);
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'customer_code' => 'required|string',
            'cs_code' => 'required|string',
            'room_code' => 'required|string',
            'sender' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 201, 'message' => 'Error Validation', 'error' => $validator->errors()]);
        }

        $data = $validator->validate();
        $room = RoomChat::where('code', $data['room_code'])->first();
        $secureMessage = Message::SecureCreate([
            'message'    => $data['message'],
            'room_code'     => $data['room_code'],
            'customer_code' => $data['customer_code'],
            'cs_code'       => $data['cs_code'],
            'sender'        => $data['sender']
        ], $room->customer->token_10, $room->department->token_16);
        MessageCreated::dispatch($secureMessage->chipertext, $data['room_code'], $data['customer_code'], $data['cs_code'], $data['sender']);
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function getMessage(Request $request)
    {
        $room = RoomChat::where('code', $request->room_code)->first();
        $message = Message::SecureRead($room->customer->token_10, $room->department->token_16, $request->message);
        $view = [
            'sender' => view('fragments.chat_sender', ['message' => $message])->render(),
            'receiver' => view('fragments.chat_receiver', ['message' => $message])->render(),
        ];
        return response()->json(['view' => $view, 'data' => $request->all()]);
    }
}
