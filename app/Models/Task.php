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
    
    protected $fillable = ['activity_id', 'user_member_id', 'task_slug', 'task_description', 'task_volume', 'task_latest_progress', 'task_attachment', 'task_active_status'];

    protected $with = ['activity', 'user', 'progress'];

    public function activity(): BelongsTo{
        return $this->belongsTo(Activity::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
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
    // public function getFormattedTenggatAttribute()
    // {
    //     return Carbon::parse($this->tenggat)
    //         ->locale('id') 
    //         ->translatedFormat('d F'); 
    // }

    // FUNGSI UNTUK MENDAPATKAN TANGGAL DIBUAT (FORMAT INDONESIA)
    // public function getFormattedCreatedatAttribute()
    // {
    //     return Carbon::parse($this->tenggat)
    //         ->locale('id') 
    //         ->translatedFormat('d F');
    // }

    // FUNGSI UNTUK MENDAPATKAN STATUS KEMAJUAN
    // public function getKemajuanAttribute(){
        
    //     $volume = $this->volume;
    //     $progress = $this->latestprogress;
    //     $tenggat = Carbon::parse($this->tenggat)->endOfDay();
    //     $createdAt = Carbon::parse($this->created_at)->startOfDay();
    //     $hariberlalu = ceil($createdAt->diffInDays(Carbon::now()->endOfDay()));
    //     $selangharitugas = ceil($tenggat->diffInDays($createdAt,true));
    //     $targetperhari = ceil($volume/$selangharitugas);
    //     $targetharustercapai_PHP = min($volume, ceil($hariberlalu * $targetperhari));

    //     if($progress == $volume){
    //         return[
    //             'status' => 'Selesai',
    //             'color' => 'blue',
    //             'hariberlalu' => $hariberlalu,
    //             'selangharitugas_PHP' => $selangharitugas,
    //             'targetperhari_PHP' => $targetperhari,
    //             'tht' => $targetharustercapai_PHP,
    //         ];
    //     }
    //     if ($tenggat < Carbon::today()){
    //         return[
    //             'status' => 'Terlambat',
    //             'color' => 'black',
    //             'hariberlalu' => $hariberlalu,
    //             'selangharitugas_PHP' => $selangharitugas,
    //             'targetperhari_PHP' => $targetperhari,
    //             'tht' => $targetharustercapai_PHP,
    //         ];
    //     }
    //     if ($progress < $targetharustercapai_PHP){
    //         return [
    //             'status' => 'Progress Lambat',
    //             'color' => 'red',
    //             'hariberlalu' => $hariberlalu,
    //             'selangharitugas_PHP' => $selangharitugas,
    //             'targetperhari_PHP' => $targetperhari,
    //             'tht' => $targetharustercapai_PHP,
    //         ];
    //     } elseif ($progress == $targetharustercapai_PHP){
    //         return [
    //             'status' => 'Progress On Time',
    //             'color' => 'yellow',
    //             'hariberlalu' => $hariberlalu,
    //             'selangharitugas_PHP' => $selangharitugas,
    //             'targetperhari_PHP' => $targetperhari,
    //             'tht' => $targetharustercapai_PHP,
    //         ];
    //     } else {
    //         return [
    //             'status' => 'Progress Cepat',
    //             'color' => 'green',
    //             'hariberlalu' => $hariberlalu,
    //             'selangharitugas_PHP' => $selangharitugas,
    //             'targetperhari_PHP' => $targetperhari,
    //             'tht' => $targetharustercapai_PHP,
    //         ];;
    //     }
    // }
    
    // FUNGSI UNTUK MENDAPATKAN PERSENTASE KEMAJUAN
    // public function getPercentageProgressAttribute(){
    //     $volume = $this->volume;
    //     $progress = $this->latestprogress;
    //     $percentageprogress = floor($progress/$volume*100);
    //     return $percentageprogress;
    // }
}