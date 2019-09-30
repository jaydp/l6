<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'ident', 'description', 'active',
    ];
    protected $casts = [
        'active' => 'bool',
    ];
	
	public function roles() {
		return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
	}
	
	public static function altPermissions($permission){
		
		$altPermissions = ['*', $permission];
		$permParts = explode('.', $permission);

		if ($permParts && count($permParts) > 1) {
			$currentPermission = '';
			for ($i = 0; $i < (count($permParts) - 1); $i++) {
				$currentPermission .= $permParts[$i] . '.';
				$altPermissions[] = $currentPermission . '*';
			}
		}

		return $altPermissions;
		
	}
	
}
