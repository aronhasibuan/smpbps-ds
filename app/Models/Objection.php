<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objection extends Model
{
    /** @use HasFactory<\Database\Factories\ObjectionFactory> */
    use HasFactory;

    protected $fillable = ['task_id', 'objection_reason', 'objection_status'];

    public function task(): BelongsTo{
        return $this->belongsTo(Task::class, 'task_id');
    }
}
