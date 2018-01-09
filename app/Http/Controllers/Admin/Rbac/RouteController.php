<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\Controller;
use Lanmeng\LaravelRbac\Permission;
use Lanmeng\LaravelRbac\Requests\RouteRequest;
use Lanmeng\LaravelRbac\Role;
use Lanmeng\LaravelRbac\Route;

class RouteController extends Controller
{
    public function index()
    {
        return view('admin.rbac.route.index', [
            'data' => Route::paginate(10),
        ]);
    }

    public function create()
    {
        $data = [
            'permission' => Permission::pluck('display_name', 'id')->toArray(),
            'role' => Role::pluck('display_name', 'id')->toArray(),
            'selectPermission' => [],
            'selectRole' => [],
        ];

        return view('admin.rbac.route.form', $data);
    }

    public function store(RouteRequest $request)
    {
        $route = Route::create($request->all());

        // 关联数据
        $route->setPermissions($request->get('permissions', []));
        $route->setRoles($request->get('roles', []));

        return redirect()->route('admin.rbac.route.index');
    }

    public function edit(Route $route)
    {
        // 角色 与 权限
        $selectPermission = $route->permissions->pluck('id')->toArray();
        $selectRole = $route->roles->pluck('id')->toArray();

        $data = [
            'data' => $route,
            'permission' => Permission::pluck('display_name', 'id')->toArray(),
            'role' => Role::pluck('display_name', 'id')->toArray(),
            'selectPermission' => $selectPermission,
            'selectRole' => $selectRole,
        ];

        return view('admin.rbac.route.form', $data);
    }

    public function update(RouteRequest $request, Route $route)
    {
        $route->update($request->all());

        // 关联数据
        $route->setPermissions($request->get('permissions', []));
        $route->setRoles($request->get('roles', []));

        return redirect()->route('admin.rbac.route.index');
    }

    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->back();
    }
}
