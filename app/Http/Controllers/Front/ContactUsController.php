<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;

	class ContactUsController extends Controller {
		public function index()
		{
			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['active'] = trans('custom.student_files');

			$page_title = trans('custom.contact_us');
			return view('front.contactUs',compact('page_title','breadcrumb_overwrite'));
		}
	}
