<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user1_id', 'user2_id', 'status_user1', 'status_user2'];

    public function directMessages()
    {
        return $this->hasMany(DirectMessage::class);
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id', 'id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id', 'id');
    }

    // Notifications that belong to the current user
    public function notification()
    {
        return $this->hasOne(DirectMessageNotification::class, 'conversation_id', 'id')->where(['recipient_id' => auth()->id()]);
    }

}
