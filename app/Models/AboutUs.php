<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $fillable = ['title', 'content_1', 'content_2', 'content_3', 'content_4'];
    // -----------------------------------------------------------
    public function socialLinks()
    {
        return $this->hasMany(AboutSocialLink::class, 'about_id');
    }
    public function services()
    {
        return $this->hasMany(AboutService::class, 'about_id');
    }
}

