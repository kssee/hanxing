<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForChineseTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title_zh')->nullable();
        });

        Schema::table('news_events', function (Blueprint $table) {
            $table->string('title_zh')->nullable();
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
            $table->dropColumn('title_zh');
        });

        Schema::table('news_events', function (Blueprint $table) {
            $table->dropColumn('title_zh');
        });
    }
}
