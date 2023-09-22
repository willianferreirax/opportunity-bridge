<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OpportunityUser extends Pivot
{
    protected $table = 'opportunity_user';

    protected $fillable = [
        'id',
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

    public function interview()
    {
        return $this->hasMany(Interview::class, 'opportunity_user_id');
    }

    public function videoInterview()
    {
        return $this->hasMany(VideoInterview::class, 'opportunity_user_id');
    }
}
