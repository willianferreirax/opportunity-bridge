<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUserPhone extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'ddd',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(CompanyUser::class, 'user_id');
    }
}
