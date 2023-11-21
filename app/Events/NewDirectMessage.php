<?php

namespace App\Events;

use App\Models\DirectMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDirectMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

/**
     * Create a new event instance.
     */
    public function __construct(private DirectMessage $message)
    {
    }

    public function broadcastOn()
    {
        return new PresenceChannel('conversation:' . $this->message->conversation_id);
    }

    public function broadcastAs()
    {
        return 'directMessage.new';
    }

    public function broadcastWith(): array
    {
        return ['message' => $this->message];
    }
}
