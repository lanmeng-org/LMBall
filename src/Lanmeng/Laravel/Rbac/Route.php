<?php
namespace Lanmeng\Laravel\Rbac;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'rbac_route';

    protected $fillable = [
        'route',
        'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'rbac_route_perms');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_route_roles');
    }

    public function setPermissions(array $permission_ids)
    {
        $insert = [];

        foreach ($permission_ids as $permission_id) {
            $insert[] = [
                'route_id' => $this->getKey(),
                'permission_id' => $permission_id,
            ];
        }

        \DB::table('rbac_route_perms')->where('route_id', $this->getKey())->delete();
        if (sizeof($insert)) {
            \DB::table('rbac_route_perms')->insert($insert);
        }
    }

    public function setRoles(array $role_ids)
    {
        $insert = [];

        foreach ($role_ids as $role_id) {
            $insert[] = [
                'route_id' => $this->getKey(),
                'role_id' => $role_id,
            ];
        }

        \DB::table('rbac_route_roles')->where('route_id', $this->getKey())->delete();
        if (sizeof($insert)) {
            \DB::table('rbac_route_roles')->insert($insert);
        }
    }
}
