<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    protected $table = 'company_categories';
    public $timestamps = false;
    protected $fillable = ['company_id', 'category_id'];
    // -----------------------------------------------------------
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
