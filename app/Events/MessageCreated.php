<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $room_id;
    public $sender, $receiver, $role_identity;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $room_id, $sender, $receiver, $role_identity)
    {
        $this->message = $message;
        $this->room_id = $room_id;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->role_identity = $role_identity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("messages." . $this->room_id)
        ];
    }
}
