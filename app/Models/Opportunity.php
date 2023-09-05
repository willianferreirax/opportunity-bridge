<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'role',
        'resume',
        'status',
        'hiring_regime',
        'job_type',
        'work_start',
        'work_end',
        'salary_start',
        'salary_end',
        'vacancies',
        'benefits',
        'is_pcd',
        'competences',
        'requirements',
        'responsabilities',
        'is_remote',
    ];

    protected $casts = [
        'is_pcd' => 'boolean',
        'is_remote' => 'boolean',
    ];

    public function simpleSteps()
    {
        return $this->hasMany(SimpleStep::class);
    }

    public function videoSteps()
    {
        return $this->hasMany(VideoStep::class);
    }

    public function interviewSteps()
    {
        return $this->hasMany(InterviewStep::class);
    }

    public function testSteps()
    {
        return $this->hasMany(TestStep::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function targetUsers()
    {
        return $this->belongsToMany(Deficiency::class, 'target_users')
            ->using(TargetUsers::class)
            ->withPivot([
                'opportunity_id',
                'deficiency_id',
            ])
            ->withTimestamps()
        ;
    }

    public function appliedUsers()
    {
        return $this->belongsToMany(User::class)
            ->using(OpportunityUser::class)
            ->withPivot(['current_step', 'status', 'user_id'])
            ->withTimestamps()
        ;
    }

    
}
