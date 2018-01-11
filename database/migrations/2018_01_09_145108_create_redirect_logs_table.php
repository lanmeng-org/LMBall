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
            $table->unsignedInteger('client_ip')->nullable()->comment('IP');
            $table->string('client_country')->nullable()->comment('国家');
            $table->string('client_city')->nullable()->comment('城市');
            $table->string('client_region')->nullable()->comment('地区');
            $table->string('client_isp')->nullable()->comment('运营商');
            $table->string('client_browser_user_agent')->nullable()->comment('浏览器UA');
            $table->string('client_browser')->nullable()->comment('浏览器');
            $table->string('client_os')->nullable()->comment('操作系统');

            $table->string('referer_domain')->nullable()->comment('来路域名');
            $table->string('referer_url')->nullable()->comment('来路地址');

            $table->timestamps();

            $table->index('domain_id');
            $table->index('url_id');
            $table->index('client_country');
            $table->index('client_city');
            $table->index('client_region');
            $table->index('client_isp');
            $table->index('client_browser');
            $table->index('client_os');
            $table->index('referer_domain');
            $table->index('referer_url');
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
