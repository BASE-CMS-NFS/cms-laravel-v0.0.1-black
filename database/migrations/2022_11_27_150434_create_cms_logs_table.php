<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ipaddress')->nullable();
            $table->string('useragent')->nullable();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('details')->nullable();
            $table->string('users_id')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_logs');
    }
}
