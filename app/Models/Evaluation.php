<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluationFactory> */
    use HasFactory;

    protected $fillable = ['task_id', 'evaluation_tidiness', 'evaluation_comprehensiveness'];

    public function task(): BelongsTo{
        return $this->belongsTo(Task::class);
    }
}
