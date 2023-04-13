<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomChatController extends Controller
{
    public function open(RoomChat $room, Request $request)
    {
        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'customer' => $room->customer,
            'departments' => Department::latest()->get()
        ];
        return view('pages.chat.index', $data);
    }
}
