<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('cms_modules_id');
            $table->integer('parent_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('name')->unique();
            $table->string('url');
            $table->string('type');
            $table->string('main_folder');
            $table->string('sub_folder');
            $table->integer('sorter');
            $table->string('status');
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
        Schema::dropIfExists('cms_menus');
    }
}
