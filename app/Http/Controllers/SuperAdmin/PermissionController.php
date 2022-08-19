<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public  function create()
    {
        return view('permissions.add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>['required','string','min:3']
        ]);
        Permission::create([
            'name'=>$request->get('name'),
            'guard_name'=>'web'
        ]);
        return redirect()->route('super.admin.permissions.index');
    }

    public function update(Permission $permission, Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string|min:3'
        ]);
        $permission->update($validate);
        return redirect()->route('super.admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }

    public function roles(Permission $permission)
    {
        $roles = Role::all();
        return view('permissions.assign-role',compact('roles', 'permission'));
    }

    public function asyncRole(Request $request, Permission $permission)
    {

        $request->validate([
            'async-roles'=>'array'
        ]);

        $permission->syncRoles($request->get('async-roles'));
        return redirect()->route('super.admin.permissions.index');
    }
}
