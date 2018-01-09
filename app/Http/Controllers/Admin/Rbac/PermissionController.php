<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\Controller;
use Lanmeng\LaravelRbac\Requests\RoleRequest;
use Lanmeng\LaravelRbac\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.rbac.permission.index', [
            'data' => Permission::paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.rbac.permission.form');
    }

    public function store(RoleRequest $request)
    {
        Permission::create($request->all());

        return redirect()->route('admin.rbac.permission.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.rbac.permission.form', [
            'data'  => $permission,
        ]);
    }

    public function update(RoleRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('admin.rbac.permission.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.rbac.permission.index');
    }
}
