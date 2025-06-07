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

    protected $with = ['activity', 'user', 'progress'];

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

    // FUNGSI UNTUK MENDAPATKAN STATUS KEMAJUAN
    public function getKemajuanAttribute(){
        
        $EarnedValue = $this->task_latest_progress;
        
        $task_volume = $this->task_volume;
        $activity_end = Carbon::parse($this->activity->activity_end)->endOfDay();
        $activity_start = Carbon::parse($this->activity->activity_start)->startOfDay();
        $day_passed = ceil($activity_start->diffInDays(Carbon::now()->endOfDay()));
        $duty_days = ceil($activity_end->diffInDays($activity_start,true));
        $target_per_day = ceil($task_volume/$duty_days);
        $PlannedValue = min($task_volume, ceil($day_passed * $target_per_day));

        $Schedule_Performance_Index = $EarnedValue / $PlannedValue;
        if($EarnedValue == $task_volume){
            return[
                'status' => 'Selesai',
                'color' => 'blue',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        }
        if ($activity_end < Carbon::today()){
            return[
                'status' => 'Terlambat',
                'color' => 'black',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        }
        if ($Schedule_Performance_Index < 1 && $EarnedValue < $task_volume){
            return [
                'status' => 'Progress Lambat',
                'color' => 'red',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        } elseif ($Schedule_Performance_Index == 1  && $EarnedValue < $task_volume){
            return [
                'status' => 'Progress On Time',
                'color' => 'yellow',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        } elseif ($Schedule_Performance_Index > 1 && $EarnedValue < $task_volume){
            return [
                'status' => 'Progress Cepat',
                'color' => 'green',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        } else {
            return [
                'status' => 'Tidak Diketahui',
                'color' => 'grey',
                'hariberlalu' => $day_passed,
                'selangharitugas_PHP' => $duty_days,
                'targetperhari_PHP' => $target_per_day,
                'tht' => $PlannedValue,
            ];
        }
    }
    
    // FUNGSI UNTUK MENDAPATKAN PERSENTASE KEMAJUAN
    // public function getPercentageProgressAttribute(){
    //     $volume = $this->volume;
    //     $progress = $this->latestprogress;
    //     $percentageprogress = floor($progress/$volume*100);
    //     return $percentageprogress;
    // }
}