<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Admin\Controller;
use App\Models\User;
use Lanmeng\Laravel\Rbac\Requests\UserRequest;
use Lanmeng\Laravel\Rbac\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.rbac.user.index', [
            'data' => User::paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.rbac.user.form', [
            'roles' => Role::pluck('display_name', 'id')->toArray(),
            'selectRole' => [],
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->get('password')),
            'email' => $request->get('email'),
        ]);

        $user->setRoles($request->get('roles', []));

        return redirect()->route('admin.rbac.user.index');
    }

    public function edit(User $user)
    {
        $data = [
            'data'       => $user,
            'roles'      => Role::pluck('display_name', 'id')->toArray(),
            'selectRole' => $user->roles->pluck('id')->toArray(),
        ];

        return view('admin.rbac.user.form', $data);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ];

        if ($request->get('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }

        $user->update($data);
        $user->setRoles($request->get('roles', []));

        return redirect()->route('admin.rbac.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.rbac.user.index');
    }
}
