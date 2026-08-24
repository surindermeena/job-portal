<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // -----------------------------------------------------------
    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
