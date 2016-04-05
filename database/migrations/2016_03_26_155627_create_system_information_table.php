<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable();
            $table->string('chinese_name',64)->nullable();
            $table->string('address',64)->nullable();
            $table->string('tel_academic',28)->nullable();
            $table->string('tel_registration',28)->nullable();
            $table->string('tel_office',28)->nullable();
            $table->string('tel_hotline',28)->nullable();
            $table->string('fax',28)->nullable();
            $table->string('skype',28)->nullable();
            $table->string('email',64)->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('password')->nullable();
            $table->string('upd_by')->nullable();
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
        Schema::drop('system_information');
    }
}
