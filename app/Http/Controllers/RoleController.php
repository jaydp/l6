<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();		
		
		return view('roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
			'name' => 'required|max:255',
			'description' => 'required|max:255'
		]);
		$role = Role::create($validatedData);

		return redirect('/roles')->with('success', 'Role is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);		
		return view('roles/edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
			'name' => 'required|max:255',
			'description' => 'required|max:255'
		]);
        Role::whereId($id)->update($validatedData);

        return redirect('/roles')->with('success', 'Role is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/roles')->with('success', 'Role is successfully deleted');
    }
	
	public function permissions($role)
    {
			
        $permissions = Permission::where('active',1)->get();
		
		$controllers = [];
		foreach($permissions as $permission)
		{
			$controller_name = $permission['controller'];
			$action_name = $permission['ident'];
			$router_group = $permission['router_group'];
			$uri = $permission['uri'];
			$method = $permission['method'];
			$id = $permission['id'];
			$controllers[$controller_name][$action_name] = $permission;
		}
	
		// Search for the permission of the role
		$roles = Role::where('id',$role)->with('permissions')->first();
		
		$role_permissions = [];		
		foreach ($roles->permissions as $permission){
			$role_permissions[] = $permission->ident;			
		}
		
		return view('roles/permission', compact('roles', 'controllers', 'role_permissions'));
    }
	
	public function permissions_update(Request $request, $role_id)
	{
		$postData = $request->post();
		
		if(empty($postData['role_permission']))
			return redirect('/roles/'.$role_id.'/permissions')->with('success', 'Please select at least one permission');
		
		$role_permission_data = array();
		foreach($postData['role_permission'] as $permission)
		{
			$role_permission_data[] = array('role_id' => $role_id, 'permission_id' => $permission);
		}		
		RolePermission::where('role_id', '=', $role_id)->delete();
		
		$role_permission_data = array();
		foreach($postData['role_permission'] as $permission)
		{
			$role_permission_data[] = array('role_id' => $role_id, 'permission_id' => $permission);
		}		
		RolePermission::insert($role_permission_data);
		
		return redirect('/roles/'.$role_id.'/permissions')->with('success', 'All the permissions are successfully updated.');
		
	}
	
	public function refresh_permissions()
	{
		//Deactivate all the permission records		
		Permission::where('active',1)->update(['active' => 0]);
		
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
				
				//Find and insert or update permission with active status
				$permissions = Permission::firstOrNew(['ident' => $action_name, 'controller' => $controller_name]);
				$permissions->name = ucwords(implode(" ", explode(".", str_replace(".index","",$action_name))));
				$permissions->controller = $controller_name;
				$permissions->description = $permissions->name;
				$permissions->router_group = $router_group;
				$permissions->uri = $uri;
				$permissions->method = $method;
				$permissions->active = 1;
				$permissions->save();
				
				//$controllers[$controller_name][$action_name] = array('router_group' => $router_group, 'function' => $functions, 'uri' => $uri, 'method' => $method);
			}
		}
		
		return redirect('/roles')->with('success', 'All the permissions are successfully refreshed.');
	}
	
	
	
}

