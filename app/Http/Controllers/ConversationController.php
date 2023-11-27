<?php

namespace App\Http\Controllers;

use App\Events\NewDirectMessage;
use App\Events\NewDirectMessageNotification;
use App\Models\Conversation;
use App\Models\DirectMessage;
use App\Models\DirectMessageNotification;
use App\Models\User;
use App\Services\ConversationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function __construct(private ConversationService $service)
    {
    }

    public function getConversations()
    {
        return response()->json([
            'conversations' => Auth::user()->conversations,
            'notifications' => Auth::user()->notifications()->with(['sender', 'conversation'])->get()
        ], 200);
    }

    public function getNotifications()
    {
        return response()->json([
            'notifications' => Auth::user()->notifications()->with(['sender', 'conversation'])->get()
        ], 200);

    }

    public function checkConversationExists($recipientId)
    {
        $conversation = $this->service->getConversation($recipientId);

        if (!$this->service->checkConversation($conversation)) {
            $newConversation = $this->service->makeConversation($recipientId);
            $conversation->fill($newConversation);
            $conversation->status_user2 = 0;
            $conversation->save();
        }
        // dd($conversation);
        $conversation->load('user1', 'user2');

        return $conversation;
    }

    public function getConversation(Conversation $conversation)
    {
        if ($conversation) {

            $this->authorize('ownsConversation', $conversation);

            // Delete any notifications that belong to current user
            $conversation->notification ? $conversation->notification->delete() : '';

            $currentUserStatus = $conversation->user1_id == auth()->id() ? $conversation->status_user1 : $conversation->status_user2;

            if ($currentUserStatus == 0) {
                \abort(404);
            }

            $conversation->load('user1', 'user2');
        }

        return response()->json($conversation, 200);
    }

    public function getMessages(Conversation $conversation)
    {
        $messages = $conversation->directMessages()->with('user')->latest()->paginate(30);
        return response()->json($messages, 200);
    }

    // This sets the status to 0 for the current user only
    public function deleteConversation(Conversation $conversation)
    {
        $userStatus = $conversation->user1_id == Auth::id() ? 'status_user1' : 'status_user2';
        $this->authorize('ownsConversation', $conversation);

        $this->authorize('userStatus', [$conversation, $userStatus]);

        $userStatus == 'status_user1' ? $conversation->status_user1 = 0 : $conversation->status_user2 = 0;

        $conversation->update();

        return response()->json('Conversation deleted', 200);
    }

    public function sendMessage(Request $request, $recipientId, Conversation $conversation = null)
    {
        $message = null;
        if ($conversation) {
            $this->authorize('ownsConversation', $conversation);
            $this->authorize('verifyRecipient', [$conversation, $recipientId]);
            $message = $this->service->handleMessage($request, $recipientId, $conversation->id);
        } else {
            $message = $this->service->handleMessage($request, $recipientId);
        }

        if ($message) {
            // handleMessage() returns a directMessage model if successful, an error response otherwise
            if ($message instanceof DirectMessage) {
                $message->load('user');
                broadcast(new NewDirectMessage($message))->toOthers();
                return response()->json($message, 200);
            } else {
                return $message;
            }
        } else {
            response()->json(['errors' => ['content' => ['Message not sent. Not message exists.']]], 422);
        }
    }

    public function createNotification(User $sender, User $recipient, Conversation $conversation)
    {
        $notification = DirectMessageNotification::where('conversation_id', $conversation->id)->where('recipient_id', $recipient->id)->first();

        // Create a notification if none exist; increment counter by 1 if it exists
        if (!$notification) {
            $notification = DirectMessageNotification::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $sender->id,
                'recipient_id' => $recipient->id,
                'counter' => 1
            ]);
        } else {
            $notification->counter += 1;
            $notification->update();
        }

        $notification->load('sender', 'conversation');

        \broadcast(new NewDirectMessageNotification($notification));

        return response()->json('Notification record/event created', 200);
    }
}
