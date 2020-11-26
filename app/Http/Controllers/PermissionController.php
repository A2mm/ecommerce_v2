<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;

class PermissionController extends Controller
{
    public function unauthorizedAccess(){
        return view('owner_dashboard.errors.unauthorized_access');
    }
    
    public function index() {
        $permissions = Permission::paginate(10); 
        $countpermissions = Permission::count(); 
        return view('owner_dashboard.permissions.index', compact('permissions', 'countpermissions'));
    }

    public function permissions_get_control()
    {
        $all_used_permissions = Permission::select('id')->count();
        return view('owner_dashboard.permissions.permissions_get_control', compact('all_used_permissions'));
    }

    public function store_new_used_permissions(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40|unique:permissions|regex:/^[\p{L} ]+$/u',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;
        $permission->save();

        return redirect()->route('permissions.get.control')->withMessage(__('translations.permission_added'));   
    }

    public function add_new_used_permissions()
    {
        return view('owner_dashboard.permissions.add_new_used_permissions');
    }

    public function delete_used_permissions()
    {
        $all_used_permissions = Permission::where('name', '!=', 'Administer')->pluck('id');
        $all_roles = Role::where('name', '!=', 'Administrator')->get();

       // return $all_used_permissions;
        if (count($all_used_permissions) > 0) {
            Permission::whereIn('id', $all_used_permissions)->forceDelete();
            foreach ($all_roles as $role) {
                $role->revokePermissionTo($all_used_permissions);
            }
            return redirect()->back()->withMessage(__('translations.permissions_deleted_successfully'));
        }
        else
        {
             return redirect()->back()->withMessage(__('translations.permissions_deleted_successfully'));
        }      
    }
/*
    $perms = $role->permissions;
            $role->revokePermissionTo($perms);
            $role->delete();
*/
    public function create_used_permissions()
    {
        $all_used_permissions =    ['view sellers report',
                                    'view sellers by kilo report',
                                    'view all customers report',
                                    'view wholesale purchases report',
                                    'suspend admin',
                                    'unsuspend admin',
                                    'edit admin',
                                    'get control permissions',
                                    'create used permissions',
                                    'delete used permissions',
                                    'edit category',
                                    'edit subcategory',
                                    'delete category',
                                    'delete subcategory',
                                    'edit store',
                                    'edit seller',
                                    'delete store',
                                    'suspend seller',
                                    'view store quantities',
                                    'seller sold',
                                    'view store purchases',
                                    'seller kilo history',
                                    'view store products movements',
                                    'view store sellers',
                                    'print store week',
                                    'store ship order',
                                    'edit customer',  
                                    'suspend customer',
                                    'show customer orders',
                                    'unsuspend customer',
                                    'archive product',
                                    'unarchive product',
                                    'product discount',
                                    'view product movements',
                                    'edit product',
                                    'change product quantity',
                                    'change product price',
                                    'view product history',
                                    'view shiped orders',
                                    'search with bill',
                                    'view pos log',
                                    'view panel log',
                                    'add permission',
                                    // 'assign roles permissions',
                                    'assign users roles',
                                    'give admins roles',
                                    'view quantities rate',
                                    'add role',
                                    'create store',
                                    'view stores purchases',
                                    'create seller',
                                    'create client',
                                    'view transactions',
                                    'view specific seller',
                                    'view product prices',
                                    'view specific subcategory',
                                    'view refunds',
                                    'view specific product',
                                    'view archived products',
                                    'view all subcategories',
                                    'add product',
                                    'view all categories',
                                    'create category',
                                    'view all products',
                                    'create subcategory',
                                    'view all sellers',
                                    'all admins',
                                    'view all clients',
                                    'view all stores',
                                    'view all banners',
                                    'create banner',
                                    'edit banner',
                                    'view banner details',
                                    'delete banner',
                                    'add admin', // ecommerce permissions 
                                    'view online refunds',
                                    'pending purchases',
                                    'in_progress purchases',
                                    'delieverd purchases',
                                    'show pending',
                                   // 'manage delieverd',
                                    'cancelled purchases',
                                    'purchase status',
                                    //'online discount',
                                    'create discount',
                                   // 'show discount',
                                   // 'edit discount',
                                   // 'delete discount',
                                    'index coupon',
                                    'create coupon',
                                    'show coupon',
                                    'edit coupon',
                                    'delete coupon',
                                    'shipments',
                                    'shipment create',
                                    'shipment edit',
                                    'shipment destroy',
                                    'cancel pending purchases',
                                    'restore cancelled purchases',
                                    'view inprogress order details',
                                    'view delivered order details',
                                    'view cancelled order details',
                                    'categories online',  // online categories 
                                    'categories online create',
                                    'categories online edit',
                                    'categories online destroy',
                                    'edit shipedorders details', // added shiped orders
                                    'ship known order',
                                    'edit shipedorders store',
                                    'edit shipedorders number',
                                    'edit shipedorders product',
                                    'edit shipedorders quantity',
                                    'settle stock', // added new
                                    'refund stock',
                                    'transfer order', 
                                    'view store refunds',
                                    'view store settlements',
                                    'view store transfers',
                                    'edit refunds details',  // new 
                                    'edit refunds product',
                                    'edit refunds quantity',
                                    'edit refunds store',
                                    'edit refunds number',
                                    'edit settles details', // new 
                                    'edit settles product',
                                    'edit settles quantity',
                                    'edit settles store',
                                    'edit settles number',
                                    'edit transfers details', // new 
                                    'edit transfers product',
                                    'edit transfers quantity',
                                    'edit transfers store',
                                    'edit transfers number',
                                    'add new stock refund', // for add button  
                                    'add new stock settle', 
                                    'add new stock transfer',
                                    'view all tags',  // for tags
                                    'create tag',
                                    'edit tag',
                                    'delete tag',  
                                    ];

        foreach ($all_used_permissions as $key => $perm) {
            $perm_found = Permission::where('name', $perm)->first();
           // return $perm_found;
            if ($perm_found) {
                continue;
                // return redirect()->back()->withMessage(__('translations.permission_already_exists'));
            }
            else{
                 // Permission::create(['name' => $perm]);
                    $permission = new Permission();
                    $permission->name = $perm;
                    $permission->save();
            }
        }
        return redirect()->back()->withMessage(__('translations.permissions_updated_successfully'));
    }

    public function create() {
        $roles = Role::get(); //Get all roles

        return view('owner_dashboard.permissions.create')->with('roles', $roles);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40|unique:permissions|regex:/^[\p{L} ]+$/u',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                $permission = Permission::where('name', '=', $name)->first(); 
                   //Match input //permission to db record
                $r->givePermissionTo($permission);
            }

             $activity_this_permission = Activity::where('subject_id', $permission->id)
                             ->where('subject_type', 'Spatie\Permission\Models\Permission')->first();
             $activity_this_permission->old_permissions = json_encode($roles);  
             $activity_this_permission->save();                     
        }
       // return $roles;

        return redirect()->route('permissions.all')->withMessage(__('translations.permission_added'));
    }

    public function show($id) {
        return redirect()->route('permissions.all');
    }

    public function edit($id) {
        $permission = Permission::findOrFail($id);
        return view('owner_dashboard.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id) 
    {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40|unique:permissions,name,'.$permission->id,  
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.all')->withMessage(__('translations.permission_updated'));

    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);
    //Make it impossible to delete this specific permission    
    if ($permission->name == "Administer") {
            return redirect()->route('permissions.all')
                             ->withMessage(__('translations.cannot_delete_this_ permission!'));
        }
        $permission->forceDelete();
         return redirect()->route('permissions.all')
                          ->withMessage(__('translations.permission_deleted'));
    }
}



















