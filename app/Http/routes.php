<?php

	Route::group(['middleware' => 'web'], function ()
	{
		Route::any('elfinder/connector', array(
			'middleware' => 'auth',
			'as'         => 'elfinder.connector',
			'uses'       => '\Barryvdh\Elfinder\ElfinderController@showConnector'
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
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'user.index',
						'create' => 'user.create',
						'store'  => 'user.store',
						'edit'   => 'user.edit',
						'update' => 'user.update',
					]
				]);
				Route::get('users/{users}/destroy', ['as' => 'user.destroy', 'uses' => 'Admin\UsersController@destroy']);


				//Permission management
				Route::resource('permissions', 'Admin\PermissionsController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'permission.index',
						'create' => 'permission.create',
						'store'  => 'permission.store',
						'edit'   => 'permission.edit',
						'update' => 'permission.update',
					]
				]);
				Route::get('permissions/{permissions}/destroy', ['as' => 'permission.destroy', 'uses' => 'Admin\PermissionsController@destroy']);


				//Role management
				Route::resource('roles', 'Admin\RolesController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'role.index',
						'create' => 'role.create',
						'store'  => 'role.store',
						'edit'   => 'role.edit',
						'update' => 'role.update',
					]
				]);
				Route::get('roles/{roles}/destroy', ['as' => 'role.destroy', 'uses' => 'Admin\RolesController@destroy']);
				Route::get('roles/{roles}/permission', ['as' => 'role.permission', 'uses' => 'Admin\RolesController@permission']);
				Route::patch('roles/{roles}/permission', ['as' => 'role.storePermission', 'uses' => 'Admin\RolesController@permissionStore']);


				//Pages management
				Route::resource('pages', 'Admin\PagesController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'page.index',
						'create' => 'page.create',
						'store'  => 'page.store',
						'edit'   => 'page.edit',
						'update' => 'page.update',
					]
				]);
				Route::get('pages/{pages}/destroy', ['as' => 'page.destroy', 'uses' => 'Admin\PagesController@destroy']);


				//NewsEvents management
				Route::resource('news-events', 'Admin\NewsEventsController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'ne.index',
						'create' => 'ne.create',
						'store'  => 'ne.store',
						'edit'   => 'ne.edit',
						'update' => 'ne.update',
					]
				]);
				Route::get('news-events/{ne}/destroy', ['as' => 'ne.destroy', 'uses' => 'Admin\NewsEventsController@destroy']);


				//Menu management
				Route::resource('menu', 'Admin\MenuController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'menu.index',
						'create' => 'menu.create',
						'store'  => 'menu.store',
						'edit'   => 'menu.edit',
						'update' => 'menu.update',
					]
				]);
				Route::get('menu/{menu}/destroy', ['as' => 'menu.destroy', 'uses' => 'Admin\MenuController@destroy']);


				//Banner management
				Route::resource('banner', 'Admin\BannersController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'banner.index',
						'create' => 'banner.create',
						'store'  => 'banner.store',
						'edit'   => 'banner.edit',
						'update' => 'banner.update',
					]
				]);
				Route::get('banners/{banners}/destroy', ['as' => 'banner.destroy', 'uses' => 'Admin\BannersController@destroy']);


				//Student Showcases management
				Route::resource('student-showcases', 'Admin\StudentShowcasesController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'sshowcase.index',
						'create' => 'sshowcase.create',
						'store'  => 'sshowcase.store',
						'edit'   => 'sshowcase.edit',
						'update' => 'sshowcase.update',
					]
				]);
				Route::get('student-showcases/{sshowcase}/destroy', ['as'   => 'sshowcase.destroy',
				                                                     'uses' => 'Admin\StudentShowcasesController@destroy']);


				//Student Files management
				Route::resource('student-files', 'Admin\StudentFilesController', [
					'except' => ['show', 'destroy'],
					'names'  => [
						'index'  => 'sfiles.index',
						'create' => 'sfiles.create',
						'store'  => 'sfiles.store',
						'edit'   => 'sfiles.edit',
						'update' => 'sfiles.update',
					]
				]);
				Route::get('student-files/{sfiles}/destroy', ['as' => 'sfiles.destroy', 'uses' => 'Admin\StudentFilesController@destroy']);

			});
		});


		// Front Site
		Route::get('/', ['as' => 'index', 'uses' => 'Front\IndexController@index']);
		Route::get('student', ['as' => 'student', 'uses' => 'Front\StudentController@index']);
		Route::get('student/logout', ['as' => 'studentLogout', 'uses' => 'Front\StudentController@logout']);
		Route::post('student', ['as' => 'studentLogin', 'uses' => 'Front\StudentController@login']);
		Route::get('alumni', ['as' => 'alumni', 'uses' => 'Front\StudentController@alumni']);
		Route::post('alumni', ['as' => 'alumniLogin', 'uses' => 'Front\StudentController@alumniLogin']);
		Route::get('news', ['as' => 'news', 'uses' => 'Front\NewsEventsController@news']);
		Route::get('events', ['as' => 'events', 'uses' => 'Front\NewsEventsController@events']);
		Route::get('student-showcases/{type}', ['as' => 'studentShowcases', 'uses' => 'Front\StudentShowcasesController@index']);
		Route::get('news/{slug}', ['as' => 'viewNews', 'uses' => 'Front\NewsEventsController@viewNews']);
		Route::get('event/{slug}', ['as' => 'viewEvent', 'uses' => 'Front\NewsEventsController@viewEvent']);
		Route::get('contact-us', ['as' => 'contactUs', 'uses' => 'Front\ContactUsController@index']);

		Route::get('online-register', ['as' => 'onlineRegister', 'uses' => 'Front\OnlineRegisterController@index']);
		Route::post('online-register', ['as' => 'sendRegister', 'uses' => 'Front\OnlineRegisterController@sendMail']);

		Route::get('student-dashboard', ['as' => 'studentDashboard', 'uses' => 'Front\StudentFilesController@index']);
		Route::get('student-dashboard/download/{id}', ['as' => 'studentFileView', 'uses' => 'Front\StudentFilesController@download']);

		Route::get('language/{lg}', ['as' => 'setLanguage', 'uses' => 'Front\IndexController@language'])->where('lg', 'en|zh');

		Route::get('popup/{id}', ['as' => 'popupPages', 'uses' => 'Front\PagesController@popup']);
		Route::get('{slug}', ['as' => 'pages', 'uses' => 'Front\PagesController@index']);

	});
