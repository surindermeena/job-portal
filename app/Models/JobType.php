<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'job_types';
    public $timestamps = false;
    protected $fillable = ['job_id', 'type'];
    // -----------------------------------------------------------
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
