<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $room_code;
    public $customer_code, $cs_code, $sender, $time;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $room_code, $customer_code, $cs_code, $sender)
    {
        $this->message = $message;
        $this->room_code = $room_code;
        $this->customer_code = $customer_code;
        $this->cs_code = $cs_code;
        $this->sender = $sender;
        $this->time = Carbon::now()->format('H:i');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("messages." . $this->room_code)
        ];
    }
}
