<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Multicaret\Acquaintances\Models\Friendship;

class DeleteFriendRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function __construct(private Friendship $request)
    {
        //
    }

    public function broadcastOn()
    {
        // Request is cancelled by the sender
        if ($this->request->sender_id == Auth::user()->id) {
            return new PresenceChannel('user:' . $this->request->recipient->id);
        } else if ($this->request->recipient_id == Auth::user()->id) { // Request is denied by the recipient
            return new PresenceChannel('user:' . $this->request->sender->id);
        }
    }

    public function broadcastAs()
    {
        return 'friend.requestDeleted';
    }

    public function broadcastWith(): array
    {
        return ['deletedRequest' => $this->request];
    }
}
