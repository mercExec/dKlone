<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Multicaret\Acquaintances\Models\Friendship;

class RemoveFriend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function __construct(private User|Authenticatable $currentUser, private User|Authenticatable $friendRemoved)
    {
        //
    }

    public function broadcastOn()
    {
            return new PresenceChannel('user:' . $this->friendRemoved->id);
    }

    public function broadcastAs()
    {
        return 'friend.removed';
    }

    public function broadcastWith(): array
    {
        return ['friendRemoved' => $this->currentUser];
    }
}
