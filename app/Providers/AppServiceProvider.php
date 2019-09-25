<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$cacheKey = 'permissions';
		$permissions = Cache::get($cacheKey);

        if (! $permissions) {
			$permissions = Permission::pluck('ident');
			Cache::put($cacheKey, $permissions->toArray());
		} else {
			$permissions = collect($permissions);
		}
		
		$permissions->each(function(string $ident) {
			
			$user = Auth::user();
			echo "<pre>";
				print_r($user->id);
			echo "</pre>";
			exit();
			Gate::define($ident, function (User $user) use($ident) {
				$cacheKey = 'user.' . $user->id . '.permissions';
				
				echo "<pre>";
					print_r($cacheKey);
				echo "</pre>";
				exit();
				/*$userPermissions = Cache::get($cacheKey);
				
				if (! $userPermissions) {
					$userClosure = function ($query) use ($user) {
						$query->where('users.id', '=', $user->id);
					};

					$userPermissions = Permission::query()
											->whereHas('roles', function ($query) use($userClosure) {
												$query->where('active', '=', 1)
															->whereHas('users', $userClosure);
											})
											->orWhereHas('users', $userClosure)
											->groupBy('permissions.id')
											->where('active', '=', 1)
											->pluck('ident');
					Cache::put($cacheKey, $userPermissions->toArray());
				} else {
					$userPermissions = collect($userPermissions);
				}
				
				if ($userPermissions) {
					$altPermissions = altPermissions($ident);
					return null !== $userPermissions->first(function (string $ident) use($altPermissions) {
						return \in_array($ident, $altPermissions, true);
					});
				}
				
				return false;*/
			});
		});
    }
}
