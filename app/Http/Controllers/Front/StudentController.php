<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Hash;
	use Laracasts\Flash\Flash;

	class StudentController extends Controller {
		public function index()
		{
			if(session()->has('student_logged_in') && session('student_logged_in') == true)
			{
				return redirect()->route('index');
			}
			$page_title = trans('custom.student_signin');
			$username = 'student';

			return view('front.student',compact('page_title','username'));
		}

		public function alumni()
		{
			$username = 'alumni';
			$page_title = trans('custom.alumni_signin');
			return view('front.student',compact('page_title','username'));
		}

		public function alumniLogin()
		{
			return redirect()->back()->withErrors(trans('custom.wrong_password'));
		}

		public function login(Request $request)
		{
			$this->validate($request, ['password' => 'required',]);

			if(Hash::check($request->password, config('system_info')->password))
			{
				session(['student_logged_in' => true]);
				Flash::overlay(trans('custom.student_logged_in_txt'), trans('custom.welcome'));

				return redirect()->route('index');
			}
			else
			{
				return redirect()->back()->withErrors(trans('custom.wrong_password'));
			}
		}

		public function logout()
		{
			session()->forget('student_logged_in');

			return redirect()->route('index');
		}
	}
