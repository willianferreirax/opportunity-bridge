<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'company_id',
        'cep',
        'street',
        'number',
        'city',
        'state',
        'neighborhood'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
