<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;

	class ContactUsController extends Controller {
		public function index()
		{
			return view('front.contactUs');
		}
	}
