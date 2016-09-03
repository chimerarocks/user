<?php

namespace ChimeraRocks\User\Models;

use ChimeraRocks\User\Models\Permission;
use ChimeraRocks\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = "Admin";
    const ROLE_EDITOR = "Editor";
    const ROLE_REDATOR = "Redator";

    protected $table = "chimerarocks_roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules(['name' => 'required|max:255']);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chimerarocks_users_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'chimerarocks_permissions_roles', 'role_id', 'permission_id');
    }
}
