<?php

	use Illuminate\Database\Seeder;

	class defaultUserRoleAndPermission extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{

			DB::table('roles')->insert(
				[
					'id'           => '1',
					'name'         => 'admin',
					'display_name' => 'Admin',
					'description'  => 'Admin'
				]
			);

			DB::table('users')->insert(
				[
					'id'       => '1',
					'name'     => 'Admin',
					'email'    => 'admin@example.com',
					'password' => bcrypt('password'),
					'status'   => 'ACTIVE',
					'cre_by'   => 'SYSTEM',
					'upd_by'   => 'SYSTEM',
				]);

			DB::table('role_user')->insert(
				[
					'user_id' => '1',
					'role_id' => '1',
				]
			);
		}
	}
