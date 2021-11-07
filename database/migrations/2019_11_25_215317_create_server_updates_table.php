<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('server_id');
            $table->json('last_data')->nullable();
            $table->longText('html_view')->nullable();
            $table->integer('days_offline')->default('0');;
            $table->integer('days_online')->default('0');;
            $table->timestamp('current_online')->nullable();
            $table->timestamp('last_online')->nullable();
            $table->timestamp('current_offline')->nullable();
            $table->timestamp('last_offline')->nullable();
            $table->integer('last_online_count')->default(0);
            $table->integer('security_level')->default(0);
            $table->integer('reserved_slots')->default(0);
            $table->string('hostbutton_tooltip')->nullable();
            $table->string('hostbutton_url')->nullable();
            $table->string('hostbutton_gfx_url')->nullable();
            $table->string('hostbanner_url')->nullable();
            $table->string('hostbanner_gfx_url')->nullable();
            $table->string('server_created')->nullable();
            $table->string('name_phonetic')->nullable();
            $table->integer('ping')->default(0);
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
        Schema::dropIfExists('server_updates');
    }
}
