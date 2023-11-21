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

class AcceptFriendRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private Friendship $request)
    {
        //
    }

    public function broadcastOn()
    {
        return new PresenceChannel('user:' . $this->request->sender->id);
    }

    public function broadcastAs()
    {
        return 'friend.accepted';
    }

    public function broadcastWith(): array
    {
        return ['friendRequest' => $this->request];
    }

}
