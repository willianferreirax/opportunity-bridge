<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cep', 'street', 'neighborhood', 'state', 'city', 'number'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
