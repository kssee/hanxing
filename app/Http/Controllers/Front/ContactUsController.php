<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;
	use Laracasts\Flash\Flash;

	class ContactUsController extends Controller {
		public function index()
		{
			$natures = [
				''                                                   => 'Select Nature of Enquiry',
				'Programme Information'                              => 'Programme Information',
				'Scholarships / PTPTN / KPM Bursary / Financial Aid' => 'Scholarships / PTPTN / KPM Bursary / Financial Aid',
				'Intakes / Transfers'                                => 'Intakes / Transfers',
				'Payment / Fees'                                     => 'Payment / Fees',
				'Campuses / Facilities / Accomodation'               => 'Campuses / Facilities / Accomodation',
				'Appointment for Counseling'                         => 'Appointment for Counseling',
				'General Feedback'                                   => 'General Feedback',
			];

			return view('front.contactUs', compact('natures'));
		}

		public function sendMail(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'name'                        => 'required|max:50',
				'email'                       => 'required|email|max:100',
				'contact_no'                  => 'required',
				'nature'                      => 'required',
				'enquiry_message'             => 'required',
				env('GOOGLE_RECAPTCHA_PARAM') => 'alpha_dash'
			]);

			$data = [
				'name'            => $request->name,
				'email'           => $request->email,
				'contact_no'      => $request->contact_no,
				'nature'          => $request->nature,
				'enquiry_message' => $request->enquiry_message,
			];
			Mail::send('emails.contactUs', $data, function ($message) use ($data)
			{
				$message->from($data['email'], $data['name']);
				$message->to(env('MAIL_FROM'), env('MAIL_NAME'));
				$message->subject('One World HanXing :: ' . $data['nature']);
			});

			Flash::overlay(trans('custom.contact_success_txt'), trans('custom.successful'));

			return redirect()->back();
		}
	}
