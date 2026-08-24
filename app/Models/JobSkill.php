<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    protected $table = 'job_skills';
    public $timestamps = false;
    protected $fillable = ['job_id', 'skill'];
    // -----------------------------------------------------------
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
