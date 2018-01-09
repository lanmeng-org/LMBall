<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\Controller;
use Lanmeng\Laravel\Rbac\Permission;
use Lanmeng\Laravel\Rbac\Requests\RoleRequest;
use Lanmeng\Laravel\Rbac\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.rbac.role.index', [
            'data' => Role::paginate(10),
        ]);
    }

    public function create()
    {
        $data = [
            'permissions'       => Permission::pluck('display_name', 'id')->toArray(),
            'selectPermissions' => [],
        ];

        return view('admin.rbac.role.form', $data);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());

        $role->setPermissions($request->get('permissions', []));

        return redirect()->route('admin.rbac.role.index');
    }

    public function edit(Role $role)
    {
        $data = [
            'data'              => $role,
            'permissions'       => Permission::pluck('display_name', 'id')->toArray(),
            'selectPermissions' => $role->permissions->toArray(),
        ];

        return view('admin.rbac.role.form', $data);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->setPermissions($request->get('permissions', []));

        return redirect()->route('admin.rbac.role.index');
    }

    public function destroy(Permission $role)
    {
        $role->delete();

        return redirect()->route('admin.rbac.role.index');
    }
}
