<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'invite_code',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'server_user');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function first_channel()
    {
        return $this->hasOne(Channel::class)->oldest();
    }
}
