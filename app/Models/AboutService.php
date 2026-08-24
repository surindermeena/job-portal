<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutService extends Model
{
    protected $table = 'about_services';
    protected $fillable = ['about_id', 'icon','service_title', 'service_description'];
    // -----------------------------------------------------------
    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_id');
    }
}
