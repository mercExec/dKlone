<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Multicaret\Acquaintances\Models\Friendship;

class NewFriendRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private Friendship $friendRequest)
    {
        //
    }

    public function broadcastOn()
    {
        return new PresenceChannel('user:' . $this->friendRequest->recipient->id);
    }

    public function broadcastAs()
    {
        return 'friend.new';
    }

    public function broadcastWith(): array
    {
        return ['request' => $this->friendRequest];
    }
}
