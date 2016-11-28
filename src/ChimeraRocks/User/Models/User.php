<?php

namespace ChimeraRocks\User\Models;

use ChimeraRocks\User\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements Authorizable
{
    use HasApiTokens, Notifiable;

    protected $table = "chimerarocks_users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() 
    {
        return $this->belongsToMany(Role::class, 'chimerarocks_users_roles', 'user_id', 'role_id');
    }

    public function hasRole($role)
    {
        return is_string($role) ?
            $this->roles->contains('name', $role) : $role->intersect($this->roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }
}
