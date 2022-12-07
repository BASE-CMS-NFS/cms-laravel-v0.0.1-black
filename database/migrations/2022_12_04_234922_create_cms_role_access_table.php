<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsRoleAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_role_access', function (Blueprint $table) {
            $table->id();
            $table->integer('cms_role_id')->nullable();
            $table->integer('cms_menus_id')->nullable();
            $table->string('is_view')->nullable();
            $table->string('is_create')->nullable();
            $table->string('is_edit')->nullable();
            $table->string('is_delete')->nullable();
            $table->string('is_detail')->nullable();
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
        Schema::dropIfExists('cms_role_access');
    }
}
