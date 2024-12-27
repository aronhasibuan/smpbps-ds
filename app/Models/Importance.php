<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Importance extends Model
{
    /** @use HasFactory<\Database\Factories\ImportanceFactory> */
    use HasFactory;

    public function tasks(): HasMany{
        return $this->hasMany(Task::class);
    }
    
}
