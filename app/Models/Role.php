<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function allowTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::whereCode($permission)->firstOrFail();
        }

        $this->permissions()->save($permission);
    }
}
