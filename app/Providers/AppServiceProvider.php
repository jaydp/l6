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
		
		//Refresh After every 10 mins
		$expiresAt = now()->addMinutes(2);


        if (! $permissions) {
			$permissions = Permission::pluck('ident');
			Cache::put($cacheKey, $permissions->toArray(), $expiresAt);
		} else {
			$permissions = collect($permissions);
		}		
		/*$userPermissions = Cache::get('user.1.permissions');
		echo "<pre>";
			print_r($userPermissions);
		echo "</pre>";
		\DB::enableQueryLog();*/
		$permissions->each(function(string $ident) use($expiresAt) {
			
			Gate::define($ident, function ($user) use($ident, $expiresAt) {
				$cacheKey = 'user.' . $user->id . '.permissions';
				
				$userPermissions = Cache::get($cacheKey);
				
				if (! $userPermissions) {
					$userClosure = function ($query) use ($user) {
						$query->where('users.id', '=', $user->id);
					};					

					$userPermissions = Permission::query()
											->whereHas('roles', function ($query) use($userClosure) {
												$query->where('active', '=', 1)
															->whereHas('users', $userClosure);
											})
											//->orWhereHas('users', $userClosure)
											->groupBy('permissions.id')
											->where('active', '=', 1)
											->pluck('ident');
					//dd(\DB::getQueryLog());
					
					Cache::put($cacheKey, $userPermissions->toArray(), $expiresAt);
					/*echo "<pre>";
						print_r($userPermissions);
					echo "</pre>";
					
					$userPermissions = Cache::get('user.1.permissions');
					echo "<pre>";
						print_r($userPermissions);
					echo "</pre>";
					//exit();
					exit();*/
				} else {					
					$userPermissions = collect($userPermissions);
				}
				
				if ($userPermissions) {
					$altPermissions = Permission::altPermissions($ident);
					return null !== $userPermissions->first(function (string $ident) use($altPermissions) {
						return \in_array($ident, $altPermissions, true);
					});
				}
				
				return false;
			});
		});
    }
}
