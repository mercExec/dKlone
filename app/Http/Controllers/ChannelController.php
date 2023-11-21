<?php

namespace App\Http\Controllers;

use App\Events\NewChannelMessage;
use App\Models\Channel;
use App\Models\Server;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function createChannel(Request $request, Server $server)
    {
        $channel = $server->channels()->create(['name' => $request->channelName, 'type' => Channel::TEXT]);

        return response()->json($channel, 200);
    }

    public function getChannel(Channel $channel) {
        return response()->json($channel, 200);
    }

    public function getMessages(Channel $channel)
    {
        $messages = $channel->messages()->with('user')->latest()->paginate(30);
        return response()->json($messages, 200);
    }

    public function sendMessage(Request $request, Channel $channel)
    {
        $message = $channel->messages()->create([
            'user_id' => $request->user()->id,
            'channel_id' => $channel->id,
            'content' => $request->input('content')
        ]);

        $message->load('user');

        broadcast(new NewChannelMessage($message))->toOthers();

        return response()->json($message, 200);
    }
}
