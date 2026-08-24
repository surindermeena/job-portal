<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'filename',
        'original_name',
        'extension',
        'size_kb',
        'uploaded_at'
    ];
    protected $casts = [
        'uploaded_at' => 'datetime',
    ];
    // -----------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
