<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // return response()->json($request->);
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'receiver' => 'required|string',
            'sender' => 'required|string',
            'room_code' => 'required|string',
            'role_identity' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 201, 'message' => 'Error Validation', 'error' => $validator->errors()]);
        }

        $data = $validator->validate();
        MessageCreated::dispatch($data['message'], $data['room_code'], $data['sender'], $data['receiver'], $data['role_identity']);
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function getMessage(Request $request)
    {
        $view = [
            'sender' => view('fragments.chat_sender', ['message' => $request->message])->render(),
            'receiver' => view('fragments.chat_receiver', ['message' => $request->message])->render(),
        ];
        return response()->json(['view' => $view, 'data' => $request->all()]);
    }
}
