<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\DirectMessageNotification;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDirectMessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

/**
     * Create a new event instance.
     */
    public function __construct(private DirectMessageNotification $notification)
    {
    }

    public function broadcastOn()
    {
        return new PresenceChannel('user:' . $this->notification->recipient_id);
    }

    public function broadcastAs()
    {
        return 'directMessage.notification';
    }

    public function broadcastWith(): array
    {
        return ['notification' => $this->notification];
    }
}
