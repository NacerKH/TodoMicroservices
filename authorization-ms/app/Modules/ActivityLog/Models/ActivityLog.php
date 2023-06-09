<?php

namespace App\Modules\ActivityLog\Models;


use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_role',
        'class_name',
        'action',
        'title',
        'data',
    ];

    protected $appends = ['username', 'message', 'added_by'];

    protected $hidden = ['created_at', 'updated_at'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d hh:mm:ss',
    ];

    public function getMessageAttribute()
    {
        return $this->username  . __('activity_log.' . $this->action) . $this->class_name;
    }

    public function getDataAttribute()
    {
        return $this->attributes['data'] ? json_decode($this->attributes['data']) : [];
    }

    public function getTitleAttribute()
    {
        return $this->action . ' ' . $this->class_name;
    }

    public function getUsernameAttribute()
    {
        return User::find($this->user_id)->name ?? null;
    }

    public function getAddedByAttribute()
    {
        return json_decode(User::find($this->user_id)) ?? null;
    }
}
