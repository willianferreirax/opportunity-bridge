<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deficiency extends Model
{
    use HasFactory;

    protected $fillable = [
        'deficiency',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_deficiency');
    }

    public function opportunities(){
        return $this->belongsToMany(Opportunity::class, 'target_user')
            ->using(TargetUsers::class)
            ->withPivot([
                'opportunity_id',
                'deficiency_id',
            ]);
    }
}
