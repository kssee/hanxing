<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id',false,true)->default(0);
            $table->integer('active_id',false,true)->default(0);
            $table->string('name',100);
            $table->string('name_zh',100)->nullable();
            $table->string('path');
            $table->boolean('layer')->default(1);
            $table->integer('order',false,true)->default(0);
            $table->string('cre_by',50);
            $table->string('upd_by',50);
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
        Schema::drop('menu');
    }
}
