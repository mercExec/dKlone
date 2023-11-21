<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\User;
use App\Services\ServerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
    public function __construct(private ServerService $serverService)
    {
    }
    public function createServer(Request $request)
    {
        $userId = $request->user()->id;

        $icon = $request->file('image');

        $server = Server::create([
            'image' => $icon ? $icon->store('icons/servers', 'public') : null,
            'name' => $request->input('name'),
            'invite_code' => \substr(sha1(\time()), 0, 7),
            'user_id' => $userId
        ]);

        $server->users()->attach($userId, ['role' => User::ADMIN]);

        // Add channels based on template
        $template = $request->input('template') ?? 0;
        // If no template is chosen, add 2 channels (1 text 1 audio)
        $this->serverService->addChannelsByTemplate($server, $template);

        $server->load('first_channel');

        return response()->json($server, 200);
    }

    public function getUserServers(Request $request)
    {
        // Get all servers with their first channel
        $servers = $request->user()->servers()->with(['first_channel'])->get();

        return response()->json($servers, 200);
    }

    public function getServer(Request $request, Server $server)
    {
        return response()->json($server->load('channels'), 200);
    }

    public function getPublicServers()
    {
        $publicServers = Server::withCount('users')->latest()->paginate(20);
        return response()->json($publicServers, 200);
    }

    public function joinServer(Request $request, Server $server)
    {
        $alreadyJoined = Auth::user()->servers->contains($server);
        // Check if user already joined server
        if ($alreadyJoined) {
            $server->load('first_channel');
            return response()->json(['already_joined' => 'You have joined this server already', 'server' => $server], 200);
        } else {
            $server->users()->attach(Auth::id(), ['role' => User::GUEST]);

            $server->load('first_channel');

            return response()->json(['server' => $server], 200);
        }
    }
}
