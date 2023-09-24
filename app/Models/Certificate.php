<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'user_id',
    ];

    public function findByHash($hash){
        return $this->where('hash', $hash)->first();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
