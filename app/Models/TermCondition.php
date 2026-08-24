<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    public $timestamps = false;
    protected $table = 'terms_conditions';
    protected $fillable = ['title', 'content', 'status'];
}
