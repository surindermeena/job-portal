<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSocialLink extends Model
{
    protected $table = 'about_social_links';
    protected $fillable = ['about_id', 'platform', 'url', 'icon'];
    // -----------------------------------------------------------
    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_id');
    }
}
