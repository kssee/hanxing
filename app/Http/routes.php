<?php

	Route::group(['middleware' => 'web'], function ()
	{
		Route::any('elfinder/connector', array(
			'middleware' => 'auth',
			'as'=>'elfinder.connector',
			'uses' => '\Barryvdh\Elfinder\ElfinderController@showConnector'
		));

		// Admin Panel
		Route::group(['prefix' => 'admin-panel', 'as' => 'admin.'], function ()
		{
			Route::match(['get', 'post'], '/', ['as' => 'login', 'uses' => 'Auth\AuthController@adminLogin']);

			Route::group(['middleware' => 'auth'], function ()
			{
				Route::get('home', ['as' => 'home', 'uses' => 'Admin\HomeController@index']);
				Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

				Route::get('system-information', ['as' => 'systemInfo.edit', 'uses' => 'Admin\HomeController@editSystemInformation']);
				Route::post('system-information', ['as' => 'systemInfo.update', 'uses' => 'Admin\HomeController@updateSystemInformation']);

				// User management
				Route::resource('users', 'Admin\UsersController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'user.index',
						'create'  => 'user.create',
						'store'   => 'user.store',
						'edit'    => 'user.edit',
						'update'  => 'user.update',
					]
				]);
				Route::get('users/{users}/destroy', ['as' => 'user.destroy', 'uses' => 'Admin\UsersController@destroy']);


				//Permission management
				Route::resource('permissions', 'Admin\PermissionsController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'permission.index',
						'create'  => 'permission.create',
						'store'   => 'permission.store',
						'edit'    => 'permission.edit',
						'update'  => 'permission.update',
					]
				]);
				Route::get('permissions/{permissions}/destroy', ['as' => 'permission.destroy', 'uses' => 'Admin\PermissionsController@destroy']);


				//Role management
				Route::resource('roles', 'Admin\RolesController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'role.index',
						'create'  => 'role.create',
						'store'   => 'role.store',
						'edit'    => 'role.edit',
						'update'  => 'role.update',
					]
				]);
				Route::get('roles/{roles}/destroy', ['as' => 'role.destroy', 'uses' => 'Admin\RolesController@destroy']);
				Route::get('roles/{roles}/permission', ['as' => 'role.permission', 'uses' => 'Admin\RolesController@permission']);
				Route::patch('roles/{roles}/permission', ['as' => 'role.storePermission', 'uses' => 'Admin\RolesController@permissionStore']);



				//Pages management
				Route::resource('pages', 'Admin\PagesController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'page.index',
						'create'  => 'page.create',
						'store'   => 'page.store',
						'edit'    => 'page.edit',
						'update'  => 'page.update',
					]
				]);
				Route::get('pages/{pages}/destroy', ['as' => 'page.destroy', 'uses' => 'Admin\PagesController@destroy']);


				//NewsEvents management
				Route::resource('news-events', 'Admin\NewsEventsController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'ne.index',
						'create'  => 'ne.create',
						'store'   => 'ne.store',
						'edit'    => 'ne.edit',
						'update'  => 'ne.update',
					]
				]);
				Route::get('news-events/{ne}/destroy', ['as' => 'ne.destroy', 'uses' => 'Admin\NewsEventsController@destroy']);



				//Menu management
				Route::resource('menu', 'Admin\MenuController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'menu.index',
						'create'  => 'menu.create',
						'store'   => 'menu.store',
						'edit'    => 'menu.edit',
						'update'  => 'menu.update',
					]
				]);
				Route::get('menu/{menu}/destroy', ['as' => 'menu.destroy', 'uses' => 'Admin\MenuController@destroy']);


				//Banner management
				Route::resource('banner', 'Admin\BannersController', [
					'except' => ['show','destroy'],
					'names'  => [
						'index'   => 'banner.index',
						'create'  => 'banner.create',
						'store'   => 'banner.store',
						'edit'    => 'banner.edit',
						'update'  => 'banner.update',
					]
				]);
				Route::get('banners/{banners}/destroy', ['as' => 'banner.destroy', 'uses' => 'Admin\BannersController@destroy']);

			});
		});





		// Front Site
		Route::get('/', ['as' => 'index', 'uses' => 'Front\IndexController@index']);
		Route::get('activity/{type}', ['as' => 'newsEvents', 'uses' => 'Front\NewsEventsController@index'])->where('type','news|events');
		Route::get('{slug}', ['as' => 'pages', 'uses' => 'Front\PagesController@index']);


	});
