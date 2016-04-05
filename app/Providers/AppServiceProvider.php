<?php

	namespace App\Providers;

	use App\Models\SystemInformation;
	use Illuminate\Support\ServiceProvider;

	class AppServiceProvider extends ServiceProvider {
		/**
		 * Bootstrap any application services.
		 *
		 * @return void
		 */
		public function boot()
		{
			try
			{
				$system_info = SystemInformation::first();
			}catch(\Exception $e)
			{
				$system_info = NULL;
			}


			config(['system_info' => $system_info]);
		}

		/**
		 * Register any application services.
		 *
		 * @return void
		 */
		public function register()
		{

		}
	}
