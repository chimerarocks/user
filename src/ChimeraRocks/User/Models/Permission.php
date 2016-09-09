<?php

namespace ChimeraRocks\User\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "chimerarocks_permissions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
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
        $validator->setRules([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }

    public function roles()
    {
        return $this->belongsToMany(Permission::class, 'chimerarocks_permissions_roles', 'permission_id', 'role_id');
    }
}