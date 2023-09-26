<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPersonalData extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sex', 'skin_id', 'gender_id', 'nacionality'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function skin(){
        return $this->belongsTo(Skin::class);
    }
}
