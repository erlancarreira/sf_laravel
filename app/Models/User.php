<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name', 
        'address', 
        'district', 
        'phone', 
        'email', 
        'password', 
        'image' 
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
        return $this->belongsToMany(\App\Models\Role::class);
    }
     
    public function hasPermission(Permission $permission) 
    {
        return $this->hasAnyRoles($permission->roles);
    } 

    public function hasAnyRoles($roles) 
    {
        
        if (is_array($roles) || is_object($roles)) {
           // dd($roles->intersect($this->roles)->count());
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }

    

    public function itens()
    {   
        return $this->hasMany(Item::class);
    }
}
