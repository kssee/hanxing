<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('path_banner')->nullable();
            $table->string('path_thumbnail')->nullable();
            $table->string('child_page_id')->nullable();
            $table->tinyInteger('child_display_category',false,true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['path_banner','path_thumbnail','child_page_id','child_display_category']);
        });
    }
}
