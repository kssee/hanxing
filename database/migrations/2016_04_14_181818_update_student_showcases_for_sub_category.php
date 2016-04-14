<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	class UpdateStudentShowcasesForSubCategory extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::table('student_showcases', function (Blueprint $table)
			{
				$table->string('subcategory', 100)->nullable();
				$table->string('subcategory_zh', 100)->nullable();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::table('student_showcases', function (Blueprint $table)
			{
				$table->dropColumn(['subcategory', 'subcategory_zh']);
			});
		}
	}
