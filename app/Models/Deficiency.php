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
}
