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
				if(trans()->locale() == 'en')
				{
					$name = $entry->title;
				}
				else
				{
					$name = $entry->title_zh;
				}
				$programmeList[ $entry->title ] = $name;
			}

			$monthList = [
				''          => trans('custom.select_a_month'),
				'January'   => trans('custom.january'),
				'February'  => trans('custom.february'),
				'March'     => trans('custom.march'),
				'April'     => trans('custom.april'),
				'May'       => trans('custom.may'),
				'June'      => trans('custom.june'),
				'July'      => trans('custom.july'),
				'August'    => trans('custom.august'),
				'September' => trans('custom.september'),
			];

			$contacted_method = [
				''         => trans('custom.contacted_method'),
				'Mobile'   => trans('custom.mobile'),
				'WhatsApp' => trans('custom.whatsapp'),
				'Email'    => trans('custom.email'),
			];

			$current_year = date('Y');

			$yearList['']              = trans('custom.select_a_year');
			$yearList[ $current_year ] = $current_year;
			for($i = $current_year; $i < $current_year + 5; $i ++)
			{
				$yearList[ $i ] = $i;
			}

			$page_title = trans('custom.online_register');
			return view('front.onlineRegister', compact('programmeList', 'monthList', 'yearList', 'contacted_method','page_title'));
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
