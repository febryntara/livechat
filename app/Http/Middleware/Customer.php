<?php

namespace App\Http\Middleware;

use App\Models\RoomChat;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $room = RoomChat::where('code', $this->getRoomIdFromUrl($request->url()))->first();
        if (is_null($room)) {
            return $this->redirect_false("Key Tidak Cocok! Untuk Mengaktifkan Room, Pastikan Masuk Lewat Link Yang Tersedia di Email Anda!");
        }
        if ($room->status == "unregistred") {
            if ($room->key == $request->key) {
                $room->status = "ready";
                $room->save();
                return $this->redirect_true('room.open', null, [$room]);
            }
            return redirect()->route('room.open', ['room' => $room, 'key' => $room->key])->with('error', 'Mencoba Terhubung Kembali');
        }

        if (!$request->has('key') || $room->key != $request->key) {
            return $this->redirect_false("Anda Tidak Memiliki Key, Pastikan Masuk Lewat Link Yang Tersedia di Email Anda!");
        }

        return $next($request);
    }

    private function redirect_true($route, $message, $extends)
    {
        return redirect()->route($route, ['room' => $extends[0], "key" => $extends[0]->key]);
    }

    private function redirect_false($message)
    {
        return redirect()->back()->with('error', $message);
    }

    private function getRoomIdFromUrl($url)
    {
        $room = strstr($url, "room-");
        $room = substr($room, 5);
        // $room = strstr($room, "?key", true);
        return $room;
    }
}
