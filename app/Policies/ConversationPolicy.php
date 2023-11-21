<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function ownsConversation(User $user, Conversation $conversation)
    {
        return ($user->id == $conversation->user1_id && $user->id != $conversation->user2_id) || ($user->id != $conversation->user1_id && $user->id == $conversation->user2_id);
    }

    public function verifyRecipient(User $user, Conversation $conversation, $recipientId)
    {
        return $conversation->user1_id == $recipientId || $conversation->user2_id == $recipientId;
    }

    public function userStatus(User $user, Conversation $conversation, $userStatus)
    {
        return ($user->id == $conversation->user1_id && $userStatus == 'status_user1') || ($user->id == $conversation->user2_id && $userStatus == 'status_user2');
    }
}
