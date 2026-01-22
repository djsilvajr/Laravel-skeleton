<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    
    protected $fillable = [
        'name',
        'description',
    ];


    public function roles()
    {
        return $this->belongsToMany(
            RolesModel::class, 
            'permission_role', 
            'permission_id', 
            'role_id'
        );
    }
}