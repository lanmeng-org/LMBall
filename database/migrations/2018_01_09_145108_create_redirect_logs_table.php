<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('domain_id');
            $table->integer('url_id');
            $table->integer('client_ip')->nullable()->comment('IP');
            $table->integer('client_country')->nullable()->comment('国家');
            $table->string('client_city')->nullable()->comment('城市');
            $table->string('client_region')->nullable()->comment('地区');
            $table->string('client_isp')->nullable()->comment('访问者运营商');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redirect_logs');
    }
}
