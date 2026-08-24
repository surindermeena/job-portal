<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'company_id',
        'status',
        'featured',
        'job_title',
        'job_description',
        'job_category',
        'salary_min',
        'salary_max',
        'min_experience',
        'application_deadline',
        'updated_at'
    ];
    protected $casts = [
        'updated_at' => 'datetime',
        'application_deadline' => 'datetime',
    ];
    // -----------------------------------------------------------
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'job_category');
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function types()
    {
        return $this->hasMany(JobType::class, 'job_id');
    }
    public function skills()
    {
        return $this->hasMany(JobSkill::class, 'job_id');
    }
    public function qualifications()
    {
        return $this->hasMany(JobQualification::class, 'job_id');
    }
    public function applicants()
    {
        return $this->belongsToMany(Candidate::class, 'applications', 'job_id', 'candidate_id')->withTimestamps();
    }
}
