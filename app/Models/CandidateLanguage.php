<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    protected $table = 'candidate_languages';
    public $timestamps = false;
    protected $fillable = ['candidate_id', 'language', 'level'];
    // -----------------------------------------------------------
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
