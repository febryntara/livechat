<?php

namespace App\Http\Controllers;

use App\Models\RoomChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomChatController extends Controller
{
    public function open(RoomChat $room, Request $request)
    {
        return $room;
    }
}
