<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChannelMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private Message $message)
    {
    }

    public function broadcastOn()
    {
        return new PresenceChannel('channel:' . $this->message->channel->server->id . '.' . $this->message->channel_id);
    }

    public function broadcastAs()
    {
        return 'message.new';
    }

    public function broadcastWith(): array
    {
        return ['message' => $this->message];
    }
}
