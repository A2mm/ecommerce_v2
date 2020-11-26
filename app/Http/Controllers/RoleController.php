<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Role;          
use Spatie\Permission\Models\Permission;   
use Spatie\Activitylog\Models\Activity;

class RoleController extends Controller
{
   /* public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    } */

    public function index() {
        $roles = Role::all();//Get all roles
        return view('owner_dashboard.roles.index')->with('roles', $roles);
    }

    public function create() {
        $permissions = Permission::all();//Get all permissions

        return view('owner_dashboard.roles.create', ['permissions'=>$permissions]);
    }

    public function store(Request $request) {
    //Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|unique:roles,name,NULL,id,deleted_at,NULL|max:50|regex:/^[\p{L} ]+$/u',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $role->save();
// return $role;
        $permissions = $request['permissions'];

        
    //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Fetch the newly created role and assign permission
            // $rolee = Role::where('id', '=', $role->id)->first(); 
            $role->givePermissionTo($p);
        }
      //  return $role->id;
       // $role_permissions = $role->permissions;
       // return $role_permissions;
       // return redirect()->route('roles.all')->withMessage(__('translations.role_added'));
       $activity_this_role = Activity::where('subject_id', $role->id)
                                      ->where('subject_type', 'Spatie\Permission\Models\Role')
                                      ->where('description', 'created')
                                      ->first();
                                    
                               //       return $activity_this_role;
       // $activity_this_role->old_permissions = json_encode($permissions);
       // $permss_ids = Permission::whereIn('id', $request->permissions)->select('name', 'created_at')->get();
        //$permss_ids = ltrim($permss_ids, '[');
        // $permss_ids = rtrim($permss_ids, '[');
       $role_permissions = $role->permissions; 
       // return $role_permissions->pluck('name');;
       // return $role_permissions->pluck('name');
        $activity_this_role->old_permissions = $role_permissions->pluck('name');
        $activity_this_role->save();
                                      // ->orderBy('created_at', 'desc')->first();
        return redirect()->route('roles.all')->withMessage(__('translations.role_added'));
        // return $activity_this_role;
    }

    public function show($id) {
         return redirect()->route('roles.all');
    }

    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('owner_dashboard.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id) 
    {
         include(app_path() . '/activityipget.php');

        $auth_user = Auth::user();
    	// return $request->all();
        $role = Role::findOrFail($id);//Get role with the given id
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        if ($role->name == $request->name) {
          // $role->update(['name' => 0]); 
          // $role->update(['name' => $request->name]); 
           // return $role->name;
             Activity::create([
                'log_name'      => 'default', 
                'description'   => 'updated', 
                'subject_type'  => 'Spatie\Permission\Models\Role', 
                'properties'    => $request->name,
                'subject_id'    => $role->id,
                'causer_id'     => $auth_user->id, 
                'ip'            => $ip,
                'causer_type'   => 'App\User',
            ]);
        }
        else
        {
           $role->update(['name' => $request->name]);   
        }
        // $role->update(['name' => $request->name]);

        $permissions = $request['permissions'];
       // $role->fill($input)->save();

        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        $role_permissions = $role->permissions;

        $last_this_role = Activity::where('subject_id', $role->id)
                                     ->where('subject_type', 'Spatie\Permission\Models\Role')
                                      ->where('description', 'updated')
                                      ->orderBy('created_at', 'desc')
                                      ->first();

        $before_last_this_role = Activity::where('subject_id', $role->id)
                                      ->where('subject_type', 'Spatie\Permission\Models\Role')
                                      ->where('description', 'updated')
                                      ->where('id', '!=', $last_this_role->id)
                                      ->orderBy('created_at', 'desc')
                                     // ->skip(1)->take(1)->get();
                                       ->first();

        if (!$before_last_this_role)
        {
          // return 'not f';
            $before_last_this_role_alt = Activity::where('subject_id', $role->id)
                                        ->where('subject_type', 'Spatie\Permission\Models\Role')
                                      ->where('description', 'created')
                                     // ->orderBy('created_at', 'desc')
                                      ->first();

           $old_permissions_alt = $before_last_this_role_alt->old_permissions;
           $last_this_role->old_permissions = $old_permissions_alt;
           $last_this_role->new_permissions = $role_permissions->pluck('name');
           $last_this_role->save();
        }
        else
        {
            $old_permissions = $before_last_this_role->new_permissions;
            $last_this_role->old_permissions = $old_permissions;
            $last_this_role->new_permissions = $role_permissions->pluck('name');
            $last_this_role->save();
        }
       //  $before_last_this_role = Activity::where('subject_id', $role->id)
         //                             ->where('description', 'created')
           //                           ->orderBy('created_at', 'desc')
             //                         ->first();
                                      // ->skip(1)->take(1)->get();
        // return $before_last_this_role;
        return redirect()->route('roles.all')->withMessage(__('translations.role_updated'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
       // return $role->permissions;
        if ($role) 
        {
            $perms = $role->permissions;
            $role->revokePermissionTo($perms);
            $role->delete();
            return redirect()->back()->withMessage(__('translations.role_deleted'));
        }
        else
        {
            return redirect()->route('roles.all')->withMessage(__('translations.role_not_found'));
        }
    }
}