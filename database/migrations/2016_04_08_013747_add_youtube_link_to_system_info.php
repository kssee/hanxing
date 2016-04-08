<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYoutubeLinkToSystemInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->string('youtube_url')->nullable();
            $table->longText('page_content')->nullable();
            $table->string('sticker_content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->dropColumn(['youtube_url','page_content','sticker_content']);
        });
    }
}
