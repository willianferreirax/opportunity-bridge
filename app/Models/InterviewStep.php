<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'opportunity_id',
        'order'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
