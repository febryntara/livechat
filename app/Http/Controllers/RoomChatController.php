<?php

namespace App\Http\Controllers;

use App\Events\RoomAppear;
use App\Models\Department;
use App\Models\Message;
use App\Models\Rating;
use App\Models\RoomChat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoomChatController extends Controller
{
    public function openForC(RoomChat $room, Request $request)
    {
        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'messages' => $room->messages->map(function ($message, $index) use ($room) {
                $message->message = Message::SecureRead($room->customer->token_10, $room->department->token_16, $message->chipertext);
                $message->view = view(($message->sender == $room->customer->code ? 'fragments.chat_sender' : 'fragments.chat_receiver'), ['message' => $message->message, 'time' => Carbon::parse($message->created_at)->format('H:i'), 'type' => $message->type, 'alias' => $message->alias])->render();
                return $message;
            }),
            'iam' => $room->customer,
            'he' => $room->department
        ];
        return view('pages.chat.index', $data);
    }
    public function openForCS(RoomChat $room, Request $request)
    {
        // <=== middleware alternatif ===>
        if ($room->status == "ready") {
            $room->status = 'active';
            $room->save();
        }

        if ($room->status == "ended") {
            return redirect()->route('chat.stack')->with('error', 'Sesi Telah Berlalu!<br>Room Tidak Dapat Diakses Kembali!');
        }
        // <=== middleware alternatif ===>

        $data = [
            'title' => 'Chat Room',
            'room' => $room,
            'messages' => $room->messages->map(function ($message, $index) use ($room) {
                $message->message = Message::SecureRead($room->customer->token_10, $room->department->token_16, $message->chipertext);
                $message->view = view(($message->sender == $room->department->code ? 'fragments.chat_sender' : 'fragments.chat_receiver'), ['message' => $message->message, 'time' => Carbon::parse($message->created_at)->format('H:i'), 'type' => $message->type, 'alias' => $message->alias])->render();
                return $message;
            }),
            'iam' => $room->department,
            'department' => $room->department,
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

    public function chatActive()
    {
        $department = auth()->user()->department;
        $data = [
            'title' => 'Chat Stack',
            'department' => $department,
            'rooms' => $department->rooms()->where('status', 'active')->get()
        ];

        return view('pages.chat.chat_stack', $data);
    }
    public function chatEnded(Request $request)
    {
        $department = auth()->user()->department;
        $data = [
            'title' => 'Chat Stack',
            'department' => $department,
            'rooms' => $department->rooms()->where('status', 'ended')->paginate(10)->withQueryString(),
            'number' => $request->has('page') ? ($request->get('page') != 1 ? ($request->get('page') - 1) * 10 + 1 : 1) : 1
        ];

        return view('pages.chat.chat_list', $data);
    }

    public function endChat(RoomChat $room, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'star_value' => 'required|numeric',
            'ending_token' => 'required|string'
        ]);

        if ($validator->fails() || $room->key != $request->ending_token) {
            return redirect()->back()->withErrors($validator)->with('error', "Terjadi Kesalahan Saat Memberi Rating!<br>SIlahkan Coba Lagi!");
        }
        Rating::create([
            'stars' => $validator->validate()['star_value'],
            'customer_code' => $room->customer->code,
            'department_code' => $room->department->code,
            'room_code' => $room->code,
        ]);

        $room->endchat();
        $request->session()->flush();
        return redirect()->route('auth.enter')->with('success', "Sesi Chat Telah Berakhir!");
    }
}
