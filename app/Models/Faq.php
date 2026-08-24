<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $timestamps = false;
    protected $table = 'faqs';
    protected $fillable = ['question', 'answer', 'status'];
}
