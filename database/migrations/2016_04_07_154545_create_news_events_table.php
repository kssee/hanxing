<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('highlight')->nullable();
            $table->boolean('published')->default('0');
            $table->date('activity_date');
            $table->string('category', 50);
            $table->longText('page_content')->nullable();
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
        Schema::drop('news_events');
    }
}
