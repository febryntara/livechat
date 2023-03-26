<?php

namespace App\Http\Controllers;

use App\Models\RoomChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomChatController extends Controller
{
    public function open(RoomChat $room, Request $request)
    {

        if ($room->status == "unregistred") {
            if ($room->key == $request->key) {
                $room->status = "ready";
                $room->save();
                return redirect()->route('room.open', ['room' => $room, "key" => $room->key]);
            }
            return redirect()->route('auth.attempt_enter')->with('error', "Key Tidak Cocok! Untuk Mengaktifkan Room, Pastikan Masuk Lewat Link Yang Tersedia di Email Anda!");
        }

        if (!$request->has('key') || $room->key != $request->key) {
            return redirect()->route('auth.attempt_enter')->with('error', "Anda Tidak Memiliki Key, Pastikan Masuk Lewat Link Yang Tersedia di Email Anda!");
        }

        return $room;
    }
}
