<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public $timestamps = false;
    protected $table = 'testimonials';
    protected $fillable = ['image', 'name', 'job_post', 'description', 'status'];
}
