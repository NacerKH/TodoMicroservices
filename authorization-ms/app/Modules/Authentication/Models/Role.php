<?php

namespace App\Modules\Authentication\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'name'
    ];
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {

        return $this->belongsToMany(User::class, 'users_roles');
    }

}
