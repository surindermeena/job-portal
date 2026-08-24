<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySkill extends Model
{
    protected $table = 'company_skills';
    public $timestamps = false;
    protected $fillable = ['company_id', 'skill'];
    // -----------------------------------------------------------
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
