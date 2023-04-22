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
            'iam' => $room->department,
            'he' => $room->customer,
        ];
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
}
