<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\SystemInformation;
	use Illuminate\Http\Request;
	use Laracasts\Flash\Flash;

	class HomeController extends Controller {
		/**
		 * HomeController constructor.
		 */
		public function __construct()
		{
			$this->middleware('permission:system_information',['only'=>['editSystemInformation','updateSystemInformation']]);
		}

		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$system_information = SystemInformation::first();

			return view('admin.home', compact('system_information'));
		}

		public function editSystemInformation()
		{
			$system_information = SystemInformation::first();

			return view('admin.editSystemInfo', compact('system_information'));
		}

		public function updateSystemInformation(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['name'             => 'required|max:64',
			                           'chinese_name'     => 'required|max:64',
			                           'address'          => 'required|max:64',
			                           'email'            => 'required|email|max:64',
			                           'tel_academic'     => 'max:28',
			                           'tel_registration' => 'max:28',
			                           'tel_office'       => 'max:28',
			                           'fax'              => 'max:28',
			                           'facebook_url'     => 'url|max:255',
			                           'password'         => 'confirmed|min:4|max:64',
			]);

			$system_info = SystemInformation::first();
			if( ! is_null($system_info))
			{
				$system_info->name             = $request->name;
				$system_info->chinese_name     = $request->chinese_name;
				$system_info->address          = $request->address;
				$system_info->email            = $request->email;
				$system_info->tel_academic     = $request->tel_academic;
				$system_info->tel_registration = $request->tel_registration;
				$system_info->tel_office       = $request->tel_office;
				$system_info->fax              = $request->fax;
				$system_info->facebook_url     = $request->facebook_url;
				$system_info->upd_by           = auth()->user()->name;

				if($request->has('password'))
				{
					$system_info->password = $request->password;
				}
				$system_info->save();

				Flash::overlay('System Information has updated', 'Successful');
			}
			else
			{
				Notie::error('System info no found');
			}


			return redirect()->route('admin.home');
		}
	}
