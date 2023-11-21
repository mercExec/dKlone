<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// // for private channel
// Broadcast::channel('channel1', function ($user) {
//     return ['ably-capability' => ["subscribe", "history"]];
// });

// // for presence channel
// Broadcast::channel('channel2', function ($user) {
//     return ['id' => $user->id, 'name' => $user->name, 'ably-capability' => ["subscribe", "presence"]];
// });

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('user:{userId}', function ($user, $userId) {
    if (Auth::check()) {
        return ['ably-capability' => ["subscribe", "presence"]];
    }
});

Broadcast::channel('all', function ($user) {
    if (Auth::check()) {
        return ['id' => $user->id, 'name' => $user->username, 'ably-capability' => ["subscribe", "presence"]];
    }
});

Broadcast::channel('channel:{serverId}.{channelId}', function ($user, $serverId, $channelId) {
    if (Auth::check()) {
        foreach ($user->servers as $server) {
            if ($server->id == $serverId) {
                return ['id' => $user->id, 'name' => $user->username, 'ably-capability' => ["subscribe", "presence"]];
            }
        }
    }
});

Broadcast::channel('conversation:{conversationId}', function ($user, $conversationId) {
    if (Auth::check()) {
        foreach ($user->conversations as $conversation) {
            if ($conversation->id == $conversationId) {
                return ['id' => $user->id, 'name' => $user->username, 'ably-capability' => ["subscribe", "presence"]];
            }
        }
    }
});
