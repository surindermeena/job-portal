<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateEducation extends Model
{
    protected $table = 'candidate_education';
    public $timestamps = false;
    protected $fillable = ['candidate_id', 'degree', 'institute', 'year'];
    // -----------------------------------------------------------
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
