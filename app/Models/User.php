<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'default_password',
        'has_changed_password',
        'profile_photo_path',
        'status',
    ];

    protected $hidden = ['password', 'remember_token', 'default_password'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

	public function getNameAttribute()
{
    return trim("{$this->first_name} {$this->last_name}");
}


    public function isRole($role)
    {
        return $this->hasRole($role);
    }
}
