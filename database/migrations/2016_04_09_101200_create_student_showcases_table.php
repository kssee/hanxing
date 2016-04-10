<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentShowcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_showcases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->boolean('published')->default('0');
            $table->date('item_date');
            $table->string('category', 50);
            $table->string('link');
            $table->string('path_thumbnail')->nullable();
            $table->string('path_file')->nullable();
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
        Schema::drop('student_showcases');
    }
}
