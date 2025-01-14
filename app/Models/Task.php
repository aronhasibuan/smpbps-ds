<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model{

    use HasFactory;
    
    protected $fillable = ['namakegiatan','slug','deskripsi','volume','satuan','tenggat','pemberitugas_id','penerimatugas_id','progress','attachment','status'];

    protected $with = ['pemberitugas','penerimatugas'];

    public function pemberitugas(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function penerimatugas(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query, array $filters): void{
        if($filters['search'] ?? false){
            $query -> where('namakegiatan', 'like', '%'.request('search').'%');
        }
    } 

    public function getWaktuTersisaAttribute(){
        Carbon::setlocale('id');
        $tenggat = Carbon::parse($this->tenggat);
        $createdAt = Carbon::parse($this->create_at);
        return $tenggat->diffForHumans($createdAt,true);
    }

    public function getFormattedTenggatAttribute()
    {
        return Carbon::parse($this->tenggat)->translatedFormat('d F Y');
    }

    public function getKemajuanAttribute(){
        
        #Volume ditugaskan dan progress
        $volume = $this->volume;
        $progress = $this->progress;

        #Hitung jumlah hari yang berlalu
        $tenggat = Carbon::parse($this->tenggat);
        $createdAt = Carbon::parse($this->created_at);
        $hariberlalu = $createdAt->diffInDays(Carbon::now());

        #Hitung target yang harusnya tercapai
        $targetperhari = $volume/$tenggat->diffInDays($createdAt,true);
        $targetharustercapai = $hariberlalu * $targetperhari;

        #Bandingkan progress dengan target tercapai
        if ($progress > $targetharustercapai){
            return [
                'status' => 'Cepat',
                'color' => 'green',
            ];
        } elseif ($progress = $targetharustercapai){
            return [
                'status' => 'Tepat Waktu',
                'color' => 'yellow',
            ];
        } else {
            return [
                'status' => 'Terlambat',
                'color' => 'red',
            ];;
        }
    }

    public static function groupedByKemajuan(){
        $user = Auth::user();
        $tasks = Task::where('pemberitugas_id', $user->id)->get();
        return $tasks->groupBy(function ($task) {
            return $task->kemajuan['status'];
        });
    }
    
}