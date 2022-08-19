<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public  function create()
    {
        return view('roles.add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>['required','string','min:3']
        ]);
        Role::create([
            'name'=>$request->get('name'),
            'guard_name'=>'web'
        ]);
        return redirect()->route('super.admin.roles.index');
    }

    public function update(Role $role, Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string|min:3'
        ]);
        $role->update($validate);
        return redirect()->route('super.admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }

    public function permissions(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.give-permission',compact('permissions', 'role'));
    }

    public function givePermission(Request $request, Role $role)
    {
        $request->validate([
            'give-permission'=>'array'
        ]);

        $role->syncPermissions($request->get('give-permission'));
        return redirect()->route('super.admin.roles.index');
    }
}
