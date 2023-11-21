<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Multicaret\Acquaintances\Models\Friendship;
use Multicaret\Acquaintances\Traits\Friendable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'display_name',
        'email',
        'password',
        'dob',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    // Server roles
    const GUEST = 1;
    const MODERATOR = 2;
    const ADMIN = 3;

    // User status
    const ONLINE = 1;
    const OFFLINE = 2;

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'server_user')
            ->withPivot('role');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'user1_id')->with(['notification', 'user1', 'user2'])->where([
            ['status_user1', 1]
            ])
        ->orWhere(function($q) {
            $q->where([
                ['user2_id', Auth::id()],
                ['status_user2', 1]
            ]);
        })->orderBy('updated_at', 'desc');
    }

    public function notifications()
    {
        return $this->hasMany(DirectMessageNotification::class, 'recipient_id', 'id');
    }
}
