<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $fillable = ['user_leader_id', 'activity_name', 'activity_slug','activity_unit','activity_start', 'activity_end', 'activity_active_status'];

    public function tasks(): HasMany{
        return $this->hasMany(Task::class, 'activity_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_leader_id');
    }
    
    public function getFormattedTenggatAttribute()
    {
        return Carbon::parse($this->tenggat)
            ->locale('id') 
            ->translatedFormat('d F'); 
    }
}
