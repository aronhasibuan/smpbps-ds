<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $fillable = ['namakegiatan','slug','tenggat','pemberitugas_id','active'];

    public function tasks(): HasMany{
        return $this->hasMany(Task::class, 'kegiatan_id');
    }
}
