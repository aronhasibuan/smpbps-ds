<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name', 'team_description'];

    public function personel(): HasMany{
        return $this->hasMany(User::class, 'team_id');
    }
}