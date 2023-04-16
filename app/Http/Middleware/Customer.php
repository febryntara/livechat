<?php

namespace App\Http\Middleware;

use App\Events\RoomAppear;
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
        if ($room->key == $request->key) {
            if ($room->status == "unregistred") {
                $room->status = "ready";
                $room->save();
            }
            if ($room->status == "ready") {
                RoomAppear::dispatch($room->department, $room, $room->customer);
            }
            if ($room->status == "ended") {
                return redirect()->route('auth.enter')->with('error', 'Sesi Anda Telah Habis!<br>Silahkan Regristasi Ulang!');
            }
            return $next($request);
        }

        if (!$request->has('key') || $room->key != $request->key) {
            return $this->redirect_false("Anda Tidak Memiliki Key, Pastikan Masuk Lewat Link Yang Tersedia di Email Anda!");
        }
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
