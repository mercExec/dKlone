<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'server_id', 'type'];

    // Channel Type
    const TEXT = 1;
    const AUDIO = 2;
    const VIDEO = 3;

    // Channel templates
    const CREATE_MY_OWN = 1;
    const GAMING = 2;
    const SCHOOL_CLUB = 3;
    const STUDY_GROUP = 4;
    const FRIENDS = 5;
    const ARTISTS_CREATORS = 6;
    const LOCAL_COMMUNITY = 7;

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
