<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OpportunityUser extends Pivot
{
    protected $table = 'opportunity_user';

    protected $fillable = [
        'opportunity_id',
        'user_id',
        'status',
        'current_step',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
