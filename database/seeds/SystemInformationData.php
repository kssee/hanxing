<?php

	use Illuminate\Database\Seeder;

	class SystemInformationData extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			DB::table('system_information')->insert(
				[
					'name'             => 'One World HanXing College',
					'chinese_name'     => '大同韩新学院',
					'address'          => 'Lot 11243, Jalan Choo Lip Kung, Taman Taynton View, 56000 Cheras, Kuala Lumpur.',
					'tel_academic'     => '03-9132 5417',
					'tel_registration' => '03-9132 5418',
					'tel_office'       => '03-9132 5419',
					'fax'              => '03-9131 9204',
					'email'            => 'hanxing@hanxing.edu.my',
					'facebook_url'     => 'www.facebook.com/hanxingcollege',
					'password'         => bcrypt('hanxing'),
					'upd_by'           => 'SYSTEM',
				]
			);
		}
	}
