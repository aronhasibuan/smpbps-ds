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
    
    public function getIdFormatDeadlineAttribute()
    {
        return Carbon::parse($this->activity_end)
            ->locale('id') 
            ->translatedFormat('d F'); 
    }

    public function getIdFormatStartAttribute()
    {
        return Carbon::parse($this->activity_start)
        ->locale('id')
        ->translatedFormat('d F');
    }

    public function getTotalProgressAttribute()
    {
        $totalProgress = $this->tasks->sum('task_latest_progress');
        $totalVolume = $this->tasks->sum('task_volume');
        return $totalVolume > 0 ? round(($totalProgress / $totalVolume) * 100, 2) : 0;
    }
}
