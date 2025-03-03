<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model{

    use HasFactory;
    
    protected $fillable = ['namakegiatan','slug','deskripsi','volume','satuan','tenggat','pemberitugas_id','penerimatugas_id','progress','attachment','active'];

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

    public function getFormatteddMAttribute(){
        return Carbon::parse($this->tenggat)->translatedFormat('d M');
    }

    public function getKemajuanAttribute(){
        
        $volume = $this->volume;
        $progress = $this->progress;
        $tenggat = Carbon::parse($this->tenggat)->endOfDay();
        $createdAt = Carbon::parse($this->created_at)->startOfDay();
        $hariberlalu = ceil($createdAt->diffInDays(Carbon::now()->endOfDay()));
        $selangharitugas = ceil($tenggat->diffInDays($createdAt,true));
        $targetperhari = ceil($volume/$selangharitugas);
        $targetharustercapai_PHP = min($volume, ceil($hariberlalu * $targetperhari));

        if ($tenggat < Carbon::today()){
            return[
                'status' => 'Terlambat',
                'color' => 'black',
                'hariberlalu' => $hariberlalu,
                'selangharitugas_PHP' => $selangharitugas,
                'targetperhari_PHP' => $targetperhari,
                'tht' => $targetharustercapai_PHP,
            ];
        }

        if ($progress < $targetharustercapai_PHP){
            return [
                'status' => 'Progress Lambat',
                'color' => 'red',
                'hariberlalu' => $hariberlalu,
                'selangharitugas_PHP' => $selangharitugas,
                'targetperhari_PHP' => $targetperhari,
                'tht' => $targetharustercapai_PHP,
            ];
        } elseif ($progress == $targetharustercapai_PHP){
            return [
                'status' => 'Progress On Time',
                'color' => 'yellow',
                'hariberlalu' => $hariberlalu,
                'selangharitugas_PHP' => $selangharitugas,
                'targetperhari_PHP' => $targetperhari,
                'tht' => $targetharustercapai_PHP,
            ];
        } else {
            return [
                'status' => 'Progress Cepat',
                'color' => 'green',
                'hariberlalu' => $hariberlalu,
                'selangharitugas_PHP' => $selangharitugas,
                'targetperhari_PHP' => $targetperhari,
                'tht' => $targetharustercapai_PHP,
            ];;
        }
    }
    
    public function getPercentageProgressAttribute(){
        $volume = $this->volume;
        $progress = $this->progress;

        $percentageprogress = floor($progress/$volume*100);
        return $percentageprogress;
    }
}