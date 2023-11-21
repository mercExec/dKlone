<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\Server;

class ServerService
{
    public function addChannelsByTemplate(Server $server, $template)
    {
        $templateChannels = [];
        switch ($template) {
            case Channel::CREATE_MY_OWN:
                array_push($templateChannels, 'text-chat', 'General');
                break;
            case Channel::GAMING:
                array_push($templateChannels, 'general', 'clips-and-highlights', 'Lobby', 'Gaming');
                break;
            case Channel::SCHOOL_CLUB:
                array_push($templateChannels, 'welcome-and-rules', 'announcements', 'resources', 'general', 'meeting-plans', 'Lounge', 'Meeting Room 1', 'Meeting Room 2');
                break;
            case Channel::STUDY_GROUP:
                array_push($templateChannels, 'welcome-and-rules', 'notes-resources', 'general', 'homework-help', 'session-planning', 'off-topic', 'Lounge', 'Study Room 1', 'Study Room 2');
                break;
            case Channel::FRIENDS:
                array_push($templateChannels, 'general', 'games', 'music', 'Lounge', 'Stream Room');
                break;
            case Channel::ARTISTS_CREATORS:
                array_push($templateChannels, 'welcome-and-rules', 'announcements', 'general', 'events', 'ideas-and-feedback', 'Lounge', 'Community Hangout', 'Stream Room');
                break;
            case Channel::LOCAL_COMMUNITY:
                array_push($templateChannels, 'welcome-and-rules', 'announcements', 'resources', 'general', 'meeting-plans', 'off-topic', 'Meeting Room', 'Loung');
                break;
            default:
                array_push($templateChannels, 'text-chat', 'General');
                break;
        }

        $channels = [];

        foreach ($templateChannels as $channelName) {
            $channels[] = ['name' => $channelName, 'type' => Channel::TEXT];
        }
        $server->channels()->createMany($channels);
    }
}
