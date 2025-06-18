<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model{

    use HasFactory;
    
    protected $fillable = ['activity_id', 'user_member_id', 'status_id','task_slug', 'task_description', 'task_volume', 'task_latest_progress', 'task_attachment'];

    protected $with = ['activity', 'user', 'progress', 'status', 'objection'];

    public function activity(): BelongsTo{
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_member_id');
    }

    public function status(): BelongsTo{
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function progress(): HasMany{
        return $this->hasMany(Progress::class, 'task_id');
    }

    public function objection(): HasMany{
        return $this->hasMany(Objection::class, 'task_id');
    }

    // FUNGSI UNTUK SEARCH
    // public function scopeFilter(Builder $query, array $filters): void{
    //     if($filters['search'] ?? false){
    //         $query -> where('activity_name', 'like', '%'.request('search').'%');
    //     }
    // } 

    // FUNGSI UNTUK MENDAPATKAN WAKTU TERSISA
    // public function getWaktuTersisaAttribute(){
    //     Carbon::setlocale('id');
    //     $tenggat = Carbon::parse($this->tenggat);
    //     $createdAt = Carbon::parse($this->create_at);
    //     return $tenggat->diffForHumans($createdAt,true);
    // }

    // FUNGSI UNTUK MENDAPATKAN TANGGAL BERAKHIR (FORMAT INDONESIA)
    public function getFormattedTenggatAttribute()
    {
        return Carbon::parse($this->activity->activity_end)
            ->locale('id') 
            ->translatedFormat('d F'); 
    }

    // FUNGSI UNTUK MENDAPATKAN TANGGAL DIBUAT (FORMAT INDONESIA)
    public function getFormattedCreatedatAttribute()
    {
        return Carbon::parse($this->activity->activity_start)
            ->locale('id') 
            ->translatedFormat('d F');
    }

    
    // FUNGSI UNTUK MENDAPATKAN PERSENTASE KEMAJUAN
    public function getProgressPercentageAttribute(){
        if ($this->task_volume > 0) {
            return round(($this->task_latest_progress / $this->task_volume) * 100, 2);
        }
        return 0;      
    }
}