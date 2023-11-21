<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlockFriend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function __construct(private User $blockedUser, private User $blockedBy)
    {
        //
    }

    public function broadcastOn()
    {
        return new PresenceChannel('user:' . $this->blockedUser->id);
    }

    public function broadcastAs()
    {
        return 'friend.blocked';
    }

    public function broadcastWith(): array
    {
        return ['blockedBy' => $this->blockedBy];
    }

}
