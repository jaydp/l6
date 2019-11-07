<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all()->pluck('ident')->toArray();
		
		$controllers = [];

		foreach (\Route::getRoutes()->getRoutes() as $route)
		{
			$action = $route->getAction();
			$uri = $route->uri();
			
			if (array_key_exists('controller', $action))
			{				
				// You can also use explode('@', $action['controller']); here
				// to separate the class name from the method

				$router_group = implode(",", $action['middleware']);
				$controller = explode("@",str_replace($action['namespace']."\\","",$action['controller']));
				$controller_name = $controller[0];
				if(strpos($controller_name,'Auth')!==false) {
					continue;
				}
				
				$functions = $controller[1];
				
				$action_name = (isset($action['as']) && !empty($action['as']))?$action['as']:$functions;
				$method = implode('|', $route->methods());
				
				if(isset($controllers[$controller_name][$action_name]))
					$action_name = $action_name."_".$method;
				
				$controllers[$controller_name][$action_name] = array('router_group' => $router_group, 'function' => $functions, 'uri' => $uri, 'method' => $method);
			}
		}
		
		return view('permissions/index', compact('permissions', 'controllers'));
    }
	
	public function update(Request $request)
	{
		
	}
	
}
