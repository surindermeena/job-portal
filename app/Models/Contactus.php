<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    public $timestamps = false;
    protected $table = 'contactus';
    protected $fillable = ['full_name', 'email', 'subject', 'message', 'reply_status'];
}
