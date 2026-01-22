<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Tymon\JWTAuth\Contracts\JWTSubject;


class AuthModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'users';
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles()
    {
        return $this->belongsToMany(
            RolesModel::class, 
            'role_user',       // Tabela pivot
            'user_id',         // Chave neste model (user)
            'role_id'          // Chave no model relacionado (roles)
        );
    }

    public function hasPermission($permissionName)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permissionName)) {
                return true;
            }
        }
        return false;
    }
}