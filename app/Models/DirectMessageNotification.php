<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectMessageNotification extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'sender_id', 'recipient_id', 'counter'];

    public $timestamps = false;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id')->with(['user1', 'user2']);
    }

}
