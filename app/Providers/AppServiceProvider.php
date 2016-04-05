<?php

	namespace App\Providers;

	use App\Models\Menu;
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

			view()->composer('partials.nav', function ($view)
			{
				$menu        = [];
				$active_id   = 0;
				$menu_layer1 = Menu::where('layer', 1)->orderBy('order')->orderBy('name')->get();
				foreach($menu_layer1 as $entry)
				{
					$sub_menu    = [];
					$menu_layer2 = Menu::where('parent_id', $entry->id)->where('layer', 2)->orderBy('name')->get();
					foreach($menu_layer2 as $entry_sub)
					{
						$sub_menu[] = ['name' => $entry_sub->name, 'path' => $entry_sub->path];
						if($_SERVER['REQUEST_URI'] == '/' . $entry_sub->path)
						{
							$active_id = $entry_sub->parent_id;
						}
					}

					if($active_id == 0 && ($_SERVER['REQUEST_URI'] == '/' . $entry->path))
					{
						$active_id = $entry->id;
					}

					$menu[] = [
						'id'        => $entry->id,
						'name'      => $entry->name,
						'path'      => $entry->path,
						'active_id' => $active_id,
						'sub_menu'  => $sub_menu
					];

				}

				$view->with('menu', $menu);
			});

			view()->composer('partials.breadcrumb', function ($view)
			{
				$path = $_SERVER['REQUEST_URI'];
				$path = substr($path, 1);

				$breadcrumb['link'][] = ['Home' => route('index')];
				$active       = Menu::where('path', $path)->first();

				if(isset($active) && ! is_null($active))
				{
					if($active->parent_id)
					{
						$parent = Menu::find($active->parent_id);

						if($parent->parent_id)
						{
							$before_parent = Menu::find($parent->parent_id);
						}
					}

					if(isset($before_parent) && ! is_null($before_parent))
					{
						$breadcrumb['link'][] = [$before_parent->name => url($before_parent->path)];
					}

					if(isset($parent) && ! is_null($parent))
					{
						$breadcrumb['link'][] = [$parent->name => url($parent->path)];
					}

					$breadcrumb['active'] = $active->name;
				}
				else
				{
					$breadcrumb['active'] = 'Current Page';
				}
				$view->with('breadcrumb', $breadcrumb);
			});
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
