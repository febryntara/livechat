<?php

namespace App\Events;

use App\Models\Customer;
use App\Models\Department;
use App\Models\RoomChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoomAppear implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $department, $room, $customer;
    /**
     * Create a new event instance.
     */
    public function __construct(Department $department, RoomChat $room, Customer $customer)
    {
        $this->department = $department;
        $this->room = $room;
        $this->customer = $customer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel($this->department->code),
        ];
    }
}
