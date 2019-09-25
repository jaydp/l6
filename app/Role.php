<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'ident', 'description', 'active', 'level',
    ];
    protected $casts = [
        'active' => 'bool',
        'level' => 'int',
    ];
	
	public function permissions() {
		return $this->belongsToMany(App\Models\Permission::class, 'role_permissions', 'role_id', 'permission_id');
	}
	
	public function users() {
		return $this->hasMany(App\Models\User::class, 'role_id');
	}
	
}
