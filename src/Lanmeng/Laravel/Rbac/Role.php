<?php
namespace Lanmeng\Laravel\Rbac;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'rbac_roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'rbac_role_permissions');
    }

    public function setPermissions(array $permission_ids)
    {
        $insert = [];

        foreach ($permission_ids as $permission_id) {
            $insert[] = [
                'role_id' => $this->getKey(),
                'permission_id' => $permission_id,
            ];
        }

        \DB::table('rbac_role_permissions')->where('role_id', $this->getKey())->delete();
        if (sizeof($insert)) {
            \DB::table('rbac_role_permissions')->insert($insert);
        }
    }
}
