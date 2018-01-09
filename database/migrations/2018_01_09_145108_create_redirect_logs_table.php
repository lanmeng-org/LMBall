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
            $table->timestamps();

            $table->integer('domain_id');
            $table->integer('url_id');
            $table->integer('client_ip')->nullable()->comment('访问者IP');
            $table->string('client_position')->nullable()->comment('访问者地理位置');
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
