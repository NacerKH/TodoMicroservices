<?php

namespace App\Models;

use App\Modules\ActivityLog\Models\ActivityLog;
use App\Modules\Authentication\Models\AuthenticationLog;
use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    protected  $appends =['role','last_login'];

    public function authentication_logs()
    {
        return $this->hasMany(ActivityLog::class)->where('action', 'login');
    }
    public function getLastLoginAttribute()
    {
        return $this->authentication_logs()->latest()->first() ? 
               $this->authentication_logs()->latest()->first()->created_at->toDateTimeString(): now();
    }


}
