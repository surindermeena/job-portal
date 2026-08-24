<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'user_id',
        'user_image',
        'company_name',
        'company_image',
        'since',
        'team_size',
        'description',
        'hr_email',
        'website',
        'address',
        'pin',
        'city',
        'state',
        'country',
        'status'
    ];

    // public $timestamps = false;

    protected $dates = ['created_at', 'updated_at'];
    // -----------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_categories', 'company_id', 'category_id');
    }

    public function skills()
    {
        return $this->hasMany(CompanySkill::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(CompanySocialLink::class);
    }
}
