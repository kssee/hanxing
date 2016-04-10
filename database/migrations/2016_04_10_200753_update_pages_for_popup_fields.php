<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	class UpdatePagesForPopupFields extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::table('pages', function (Blueprint $table)
			{
				$table->integer('popup_page_id', false, true)->default(0);
				$table->string('popup_title')->nullable();
				$table->string('popup_title_zh')->nullable();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::table('pages', function (Blueprint $table)
			{
				$table->dropColumn(['popup_link', 'popup_title', 'popup_title_zh']);
			});
		}
	}
