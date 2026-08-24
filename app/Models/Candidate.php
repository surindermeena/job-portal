<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';
    protected $fillable = [
        'user_id',
        'image',
        'job_title',
        'category_id',
        'min_salary',
        'experience',
        'description',
        'address',
        'pin',
        'city',
        'state',
        'country',
        'status'
    ];
    // -----------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function skills()
    {
        return $this->hasMany(CandidateSkill::class);
    }
    public function education()
    {
        return $this->hasMany(CandidateEducation::class);
    }
    public function languages()
    {
        return $this->hasMany(CandidateLanguage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function appliedJobs()
    {
        return $this->belongsToMany(Job::class, 'applications', 'candidate_id', 'job_id');
    }
}
