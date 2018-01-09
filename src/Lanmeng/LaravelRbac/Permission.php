<?php
namespace Lanmeng\LaravelRbac;

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
