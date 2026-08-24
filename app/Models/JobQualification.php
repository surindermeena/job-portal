<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    protected $table = 'job_qualifications';
    public $timestamps = false;
    protected $fillable = ['job_id', 'qualification'];
    // -----------------------------------------------------------
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
