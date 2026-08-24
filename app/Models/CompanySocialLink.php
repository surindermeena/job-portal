<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySocialLink extends Model
{
    protected $table = 'company_social_links';
    public $timestamps = false;
    protected $fillable = ['company_id', 'url'];
    // -----------------------------------------------------------
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
