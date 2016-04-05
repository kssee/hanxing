<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->boolean('published')->default('0');
            $table->timestamp('publish_date');
            $table->string('path')->nullable();
            $table->string('path_thumbnail')->nullable();
            $table->string('cre_by', 50);
            $table->string('upd_by', 50);
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
        Schema::drop('banners');
    }
}
