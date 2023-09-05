<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TargetUsers extends Pivot
{
    protected $table = 'target_user';

    protected $fillable = [
        'opportunity_id',
        'deficiency_id',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function deficiency()
    {
        return $this->belongsTo(Deficiency::class);
    }
}
