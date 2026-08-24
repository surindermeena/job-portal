<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    protected $table = 'candidate_skills';
    public $timestamps = false;
    protected $fillable = ['candidate_id', 'name'];
    // -----------------------------------------------------------
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
