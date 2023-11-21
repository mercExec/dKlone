<?php

namespace App\Http\Controllers;

use App\Events\AcceptFriendRequest;
use App\Events\BlockFriend;
use App\Events\DeleteFriendRequest;
use App\Events\NewFriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Multicaret\Acquaintances\Models\Friendship;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function addFriend($recipient)
    {
        $recipient = User::where('username', $recipient)->first();
        $friendRequest = null;

        // Check if recipient exists
        if ($recipient) {
            // Check if user is trying to befriend themselves
            if ($recipient->id == Auth::id()) {
                return response()->json('You cant friend yourself', 401);
            } else {
                // Check if user already has a friend request from recipient
                if (Auth::user()->hasFriendRequestFrom($recipient)) {
                    Auth::user()->acceptFriendRequest($recipient);

                    $friendRequest = Auth::user()->getFriendship($recipient);
                    if ($friendRequest) {
                        $friendRequest->load('sender');
                        $friendRequest->load('recipient');
                        broadcast(new AcceptFriendRequest($friendRequest))->toOthers();
                    }
                } else {
                    Auth::user()->befriend($recipient);

                    $friendRequest = Auth::user()->getFriendship($recipient);
                    if ($friendRequest) {
                        $friendRequest->load('sender');
                        $friendRequest->load('recipient');

                        broadcast(new NewFriendRequest($friendRequest))->toOthers();
                    }
                }

                return response()->json($friendRequest, 200);
            }
        } else {
            return response()->json('This user does not exist', 404);
        }
    }

    public function acceptRequest(User $sender)
    {
        $friendRequest = Auth::user()->getFriendship($sender);
        if ($friendRequest) {
            $friendRequest->load('sender');
            $friendRequest->load('recipient');
            Auth::user()->acceptFriendRequest($sender);
            broadcast(new AcceptFriendRequest($friendRequest))->toOthers();
        }

        return response()->json($sender, 200);
    }

    public function removeFriend(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->isFriendWith($user)) {
            $currentUser->unfriend($user);
            return response()->json('Friend Removed', 200);
        } else {
            return response()->json('This user is not in your friend\'s list', 404);
        }
    }

    // This handles both canceling a request by the sender or denying a request by the recipient
    public function removeRequest(Friendship $friendshipRequest)
    {
        broadcast(new DeleteFriendRequest($friendshipRequest));

        $friendshipRequest->delete();
        return response()->json('Friendship request removed', 200);
    }

    public function getFriends()
    {
        return response()->json(Auth::user()->getFriends(), 200);
    }

    public function getPendingFriendships()
    {
        $pending = Auth::user()->getPendingFriendships();
        $pending->load('sender');
        $pending->load('recipient');
        return response()->json($pending, 200);
    }

    public function block(User $user)
    {
        if (!Auth::user()->hasBlocked($user)) {
            if (Auth::user()->isFriendWith($user)) {
                \broadcast(new BlockFriend($user, Auth::user()));
            }
            $block = Auth::user()->blockFriend($user);
            $block->load('recipient');
            return response()->json($block, 200);
        }
        return response()->json('This user is already blocked', 200);
    }

    public function unblock(User $user)
    {
        Auth::user()->unblockFriend($user);
        return response()->json('User unblocked', 200);
    }

    public function getBlockedUsers()
    {
        $blockedUsers = Auth::user()->getBlockedFriendships();
        $blockedUsers->load('recipient');
        return response()->json($blockedUsers, 200);
    }
}
