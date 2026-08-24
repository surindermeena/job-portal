<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = [
        'user_id',
        'image',
        'address',
        'pin',
        'city',
        'state',
        'country'
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
