<?php

namespace App\Services;

use App\Jobs\ConversationNotificationJob;
use App\Models\Conversation;
use App\Models\DirectMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationService {

    public function getAllConversations()
    {
        return Auth::user()->conversations;
    }

    public function getConversation($recipientId)
    {
        // If a conversation exists, the record will be returned, otherwise, an empty conversation model will be returned.
        return Conversation::where([
                ['user1_id', $recipientId],
                ['user2_id', Auth::id()],
            ])
            ->orWhere(function($q) use ($recipientId) {
                $q->where([
                    ['user1_id', Auth::id()],
                    ['user2_id', $recipientId],
                ]);
            })->firstOrNew();
    }

    // Check if the authenticated user is blocked by the recipient
    public function checkSenderBlocked($recipientId)
    {
        $recipient = User::where('id', $recipientId)->first(['id']);
        return Auth::user()->isBlockedBy($recipient);
    }

    // Check if the recipient is blocked by the authenticated user
    public function checkRecipientBlocked($recipientId)
    {
        $recipient = User::where('id', $recipientId)->first(['id']);
        return Auth::user()->hasBlocked($recipient);
    }

    public function checkConversation($conversation)
    {
        if($conversation->exists) {
            return true;
        }

        return false;
    }

    public function makeConversation($recipientId)
    {
        // Fill the new conversation data
        $newConversation = [
            'user1_id' => Auth::id(),
            'user2_id' => $recipientId,
        ];

        return $newConversation;
    }

    public function updateConversationStatus($conversation)
    {
        $conversation->status_user1 == 0 ? $conversation->status_user1 = 1 : '';
        $conversation->status_user2 == 0 ? $conversation->status_user2 = 1 : '';
        $conversation->touch();
        $conversation->update();
    }

    public function sendMessage($conversationId, $message)
    {
        $message['sender_id'] = Auth::id();
        $message['conversation_id'] = $conversationId;
        return DirectMessage::create($message);
    }

    public function handleMessage(Request $request, $recipientId, $conversationId = null)
    {
        if ($recipientId == auth()->id()) {
            \abort(401);
        }

        $message = $request->validate([
            'content' => ['required', 'max:255']
        ]);

        if ($this->checkSenderBlocked($recipientId)) {
            return response()->json(['errors' => ['content' => ['This user has blocked you.']]], 422);
        }

        if ($this->checkRecipientBlocked($recipientId)) {
            return response()->json(['errors' => ['content' => ['You have blocked this user. If you would like to contact this user, you must remove them from your blocked users list']]], 422);
        }

        $conversation = $this->getConversation($recipientId);

        /** If the request originates from the listing page (Contact Seller), it will pass this check and check if a conversation between the two users already exists.
         *  If there is a conversation, it will update the chat visiblity of both users, otherwise, it will create a new conversation. Afterwards, it will set the $conversationId
         *  with the existing conversation ID or the new one and send the message.
         *  If the request originates from the conversation page, a $conversationId will be passed with the request and the message will be sent
         */
        if (!\str_contains($request->header('referer'), '/me')) {

            if ($this->checkConversation($conversation)) {
                $this->updateConversationStatus($conversation);
            } else {
                $newConversation = $this->makeConversation($recipientId);
                $conversation->fill($newConversation);
                $conversation->save();
            }

            $conversationId = $conversation->id;
        } else {
            $this->updateConversationStatus($conversation);
        }

        $sentMessage = $this->sendMessage($conversationId, $message);

        return $sentMessage;
    }
}
