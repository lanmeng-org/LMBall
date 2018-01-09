<?php
namespace Lanmeng\LaravelRbac\Traits;

use Lanmeng\LaravelRbac\Role;

trait UserRbacTrait
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_user_roles');
    }

    public function setRoles(array $role_ids)
    {
        $insert = [];

        foreach ($role_ids as $role_id) {
            $insert[] = [
                'user_id' => $this->getKey(),
                'role_id' => $role_id,
            ];
        }

        \DB::table('rbac_user_roles')->where('user_id', $this->getKey())->delete();
        if (sizeof($insert)) {
            \DB::table('rbac_user_roles')->insert($insert);
        }
    }
}
