<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRbacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->rolesAndPermissions();
        $this->routes();
        $this->adminInfo();
    }

    protected function rolesAndPermissions()
    {
        Schema::create('rbac_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique()->comment('标识');
            $table->string('display_name')->comment('显示名称');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });

        Schema::create('rbac_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique()->comment('角色标识');
            $table->string('display_name')->comment('显示名称');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });

        Schema::create('rbac_role_permissions', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->primary(['role_id', 'permission_id']);
        });

        Schema::create('rbac_user_roles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->primary(['user_id', 'role_id']);
        });
    }

    protected function routes()
    {
        Schema::create('rbac_route', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('route')->comment('路由地址, 支持通配符');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });

        Schema::create('rbac_route_perms', function (Blueprint $table) {
            $table->integer('route_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->primary(['route_id', 'permission_id']);
        });

        Schema::create('rbac_route_roles', function (Blueprint $table) {
            $table->integer('route_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->primary(['route_id', 'role_id']);
        });
    }

    protected function adminInfo()
    {
        $dateTimes = [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        \DB::table('rbac_roles')->insert([
                'id'           => 1,
                'name'         => 'admin',
                'display_name' => '超级管理员',
                'description'  => '超级管理员',
            ] + $dateTimes);
        \DB::table('rbac_user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        \DB::table('rbac_route')->insert([
                'id'          => 1,
                'route'       => 'admin\/.*',
                'description' => '后台管理',
            ] + $dateTimes);
        \DB::table('rbac_route_roles')->insert([
            'route_id' => 1,
            'role_id'  => 1,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'rbac_route_roles', 'rbac_route_perms', 'rbac_route',
            'rbac_user_roles', 'rbac_role_permissions', 'rbac_roles', 'rbac_permissions'
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
}
