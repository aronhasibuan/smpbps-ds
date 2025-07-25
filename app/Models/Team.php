<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name', 'team_description'];

    public function users(): HasMany{
        return $this->hasMany(User::class, 'team_id');
    }
    
    public function getTeamLeadersAttribute(){
        return $this->users()->where('user_role', 'ketuatim')->get();
    }
}