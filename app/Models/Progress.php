<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class progress extends Model
{
    use HasFactory;

    protected $fillable=['task_id','progress_date','progress_amount', 'progress_notes','progress_documentation', 'progress_acceptance'];

    public function task(): BelongsTo{
        return $this->belongsTo(Task::class);
    }

    // FUNGSI UNTUK MENDAPATKAN TANGGAL PROGRESS (FORMAT INDONESIA)
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->progress_date)
            ->locale('id') 
            ->translatedFormat('d F Y'); 
    }
}
