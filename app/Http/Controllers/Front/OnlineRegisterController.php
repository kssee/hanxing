<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\Pages;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;
	use Laracasts\Flash\Flash;

	class OnlineRegisterController extends Controller {
		public function index()
		{
			$programmes        = Pages::where('category', 'programmes')->orderBy('title')->get();
			$programmeList[''] = trans('custom.select_a_course');

			foreach($programmes as $entry)
			{
				$programmeList[ $entry->title ] = $entry->title;
			}

			$monthList = [
				''          => trans('custom.select_a_month'),
				'January'   => 'January',
				'February'  => 'February',
				'March'     => 'March',
				'April'     => 'April',
				'May'       => 'May',
				'June'      => 'June',
				'July'      => 'July',
				'August'    => 'August',
				'September' => 'September',
			];

			$contacted_method = [
				''             => trans('custom.contacted_method'),
				'Phone'        => 'Phone',
				'Mobile'       => 'Mobile',
				'Social Media' => 'Social Media',
				'WhatsApp'     => 'WhatsApp',
				'Email'        => 'Email',
			];

			$current_year = date('Y');

			$yearList['']              = trans('custom.select_a_year');
			$yearList[ $current_year ] = $current_year;
			for($i = $current_year; $i < $current_year + 5; $i ++)
			{
				$yearList[ $i ] = $i;
			}

			return view('front.onlineRegister', compact('programmeList', 'monthList', 'yearList', 'contacted_method'));
		}

		public function sendMail(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'full_name'                   => 'required|max:50',
				'email'                       => 'required|email|max:100',
				'contact_no'                  => 'required',
				'programme'                   => 'required',
				'intake_year'                 => 'required|digits:4',
				'intake_month'                => 'required',
				'contacted_method'            => 'required',
				env('GOOGLE_RECAPTCHA_PARAM') => 'alpha_dash'
			]);

			$data = [
				'full_name'        => $request->full_name,
				'email'            => $request->email,
				'contact_no'       => $request->contact_no,
				'programme'        => $request->programme,
				'intake_year'      => $request->intake_year,
				'intake_month'     => $request->intake_month,
				'contacted_method' => $request->contacted_method,
			];
			Mail::send('emails.register_to_admin', $data, function ($message) use ($data)
			{
				$message->from($data['email'], $data['full_name']);
				$message->to(env('MAIL_FROM'), env('MAIL_NAME'));
				$message->subject('One World HanXing :: Online Register Notification');
			});

			Mail::send('emails.register_to_user', $data, function ($message) use ($data)
			{
				$message->from(env('MAIL_FROM'), env('MAIL_NAME'));
				$message->to($data['email'], $data['full_name']);
				$message->subject('One World HanXing :: Online Register - ' . $data['full_name']);

				$message->attach(storage_path('files/application_form.docx'), ['as' => 'application_form.docx', 'mime' => 'docx']);
			});

			Flash::overlay(trans('custom.register_success_txt'), trans('custom.successful'));

			return redirect()->back();
		}
	}
