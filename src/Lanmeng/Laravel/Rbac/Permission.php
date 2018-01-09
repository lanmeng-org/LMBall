<?php
namespace Lanmeng\Laravel\Rbac;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'rbac_permissions';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
}
