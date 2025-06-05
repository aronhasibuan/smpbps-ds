<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'user_full_name',
        'user_nickname',
        'user_role',
        'email',
        'password',
        'user_whatsapp_number',
    ];

    protected $with = ['team'];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function activities(): HasMany{
        return $this->hasMany(Activity::class, 'user_leader_id');
    }

    public function tasks(): HasMany{
        return $this->hasMany(Task::class, 'user_member_id');
    }

    public function team(): BelongsTo{
        return $this->belongsTo(Team::class);
    }
}