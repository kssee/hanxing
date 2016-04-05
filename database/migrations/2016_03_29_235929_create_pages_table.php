<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	class CreatePagesTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('pages', function (Blueprint $table)
			{
				$table->increments('id');
				$table->string('slug', 100)->unique();
				$table->string('title')->nullable();
				$table->string('highlight')->nullable();
				$table->boolean('default')->default('0');
				$table->boolean('published')->default('0');
				$table->string('category', 50);
				$table->longText('page_content')->nullable();
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
			Schema::drop('pages');
		}
	}
