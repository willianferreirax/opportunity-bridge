<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'limit_days',
        'opportunity_id',
        'order'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
