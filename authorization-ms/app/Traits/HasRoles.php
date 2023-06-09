<?php

namespace App\Traits;

use App\Modules\Authentication\Models\Role;

trait HasRoles
{
    public function initializeAppendAttributeTrait()
    {
        $this->append('role');
    }

    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }


    /**
     * sets the role using its string name .
     */
    public function setRole(string $role)
    {
        $role = Role::where('name', $role)->firstOrFail();

        return $this->roles()->sync($role);
    }

    public function role()
    {
        return $this->roles()->first();
    }

    public function getRoleAttribute()
    {
        return $this->role()?->name;
    }


    public function permissions()
    {
        return $this->role()?->permissions;
    }

    public function getPermissionsAttribute()
    {
        return $this->permissions()?->pluck('name')->toArray(true);
    }



}
