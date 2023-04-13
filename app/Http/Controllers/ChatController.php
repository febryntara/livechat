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
            'room_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 201, 'message' => 'Error Validation']);
        }

        $data = $validator->validate();
        MessageCreated::dispatch($data['message'], $data['room_code'], $data['sender'], $data['receiver']);
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function getMessage(Request $request)
    {
        // return response()->json($request->);
        $view = view('fragments.chat_receiver', ['message' => $request->message])->render();
        return response()->json($view);
    }
}
