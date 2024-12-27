<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model{

    use HasFactory;
    
    protected $fillable = ['namakegiatan','slug','deskripsi','volume','satuan','tenggat','pemberitugas','penerimatugas','progress','importancelevel','attachment','status'];

    protected $with = ['pemberitugas','penerimatugas','importance'];

    public function pemberitugas(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function penerimatugas(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function importance(): BelongsTo{
        return $this->belongsTo(Importance::class);
    }

    public function scopeFilter(Builder $query, array $filters): void{
        if($filters['search'] ?? false){
            $query -> where('namakegiatan', 'like', '%'.request('search').'%');
        }
    }
}