<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomChatController extends Controller
{
    public function openForC(RoomChat $room, Request $request)
    {
        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'iam' => $room->customer,
            'he' => Department::get()->first() //nanti ganti sama fix departemen yang udah dipilih lewat dialog
        ];
        return view('pages.chat.index', $data);
    }
    public function openForCS(RoomChat $room, Request $request)
    {
        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'iam' => Department::get()->first(), //nanti ganti sama departemen code di user
            'he' => $room->customer,
        ];
        return view('pages.chat.index', $data);
    }
}
